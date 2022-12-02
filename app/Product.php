<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'details',
        'price',
        'featured',
        'views',
        'image',
        'images'
    ];

    protected $with = [
        'subcategory'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate()
            ->usingSeparator('-');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function previous()
    {
        return Product::where('id', '<', $this->id)->latest('id')->first();
    }

    public function next()
    {
        return Product::where('id', '>', $this->id)->oldest('id')->first();
    }

    // public function getFeaturedImageAttribute()
    // {
    //     return '/storage/products/' . $this->attributes['featured_image'];
    // }

    public function getImagesAttribute()
    {
        $images = json_decode($this->attributes['images']);

        // if ($images) {
        //     foreach ($images as $key => $image) {
        //         $images[$key] = '/storage/products/' . $image;
        //     }
        // }

        return $images;
    }

    public function getShortDescriptionAttribute()
    {
        return substr(strip_tags($this->attributes['description']), 0, 500) . '...';
    }

    public function getOriginalPriceCurAttribute()
    {
        switch ($this->attributes['currency']) {
            case 'USD':
                // return dollar sign
                return '$' . $this->attributes['original_price'];
                break;
            case 'EUR':
                // return euro sign
                return '€' . $this->attributes['original_price'];
                break;
            case 'GBP':
                // return pound sign
                return '£' . $this->attributes['original_price'];
                break;
            case 'SEK':
                // return swedish krona sign
                return 'kr' . $this->attributes['original_price'];
                break;
            case 'JPY':
                // return yen sign
                return '¥' . $this->attributes['original_price'];
                break;
            default:
                // return dollar sign
                return '$' . $this->attributes['original_price'];
                break;
        }
    }

    public function getSalePriceCurAttribute()
    {
        switch ($this->attributes['currency']) {
            case 'USD':
                // return dollar sign
                return '$' . $this->attributes['sale_price'];
                break;
            case 'EUR':
                // return euro sign
                return '€' . $this->attributes['sale_price'];
                break;
            case 'GBP':
                // return pound sign
                return '£' . $this->attributes['sale_price'];
                break;
            case 'SEK':
                // return swedish krona sign
                return 'kr' . $this->attributes['sale_price'];
                break;
            case 'JPY':
                // return yen sign
                return '¥' . $this->attributes['sale_price'];
                break;
            default:
                // return dollar sign
                return '$' . $this->attributes['sale_price'];
                break;
        }
    }

    public function getRatingsAttribute()
    {
        $ratings = json_decode($this->attributes['ratings']);

        $percent = 0;
        $star1 = $ratings->oneStarCount;
        $star2 = $ratings->twoStarCount;
        $star3 = $ratings->threeStarCount;
        $star4 = $ratings->fourStarCount;
        $star5 = $ratings->fiveStarCount;

        // get total ratings as percentage from 10 to 100
        $totalStars = $star1 + $star2 + $star3 + $star4 + $star5;

        for($i = 1; $i <= 5; $i++) {
            $var = "star$i";
            $count = $$var;
            $percent = $count == 0 ? 0 : ($count * 100 / $totalStars);
        }
        
        return round($percent, -1) . '%';
    }

    public function getTotalRatingsAttribute()
    {
        $ratings = json_decode($this->attributes['ratings']);

        $star1 = $ratings->oneStarCount;
        $star2 = $ratings->twoStarCount;
        $star3 = $ratings->threeStarCount;
        $star4 = $ratings->fourStarCount;
        $star5 = $ratings->fiveStarCount;

        $total = $star1 + $star2 + $star3 + $star4 + $star5;
        return (int) $total;
    }

    public function getSpecsAttribute($value)
    {
        return json_decode($value);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
            ->orWhere('details', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%');
    }

    public function scopeSort($query, $sort)
    {
        if ($sort == 'low_high') {
            return $query->orderBy('price', 'asc');
        } elseif ($sort == 'high_low') {
            return $query->orderBy('price', 'desc');
        } elseif ($sort == 'a_z') {
            return $query->orderBy('name', 'asc');
        } elseif ($sort == 'z_a') {
            return $query->orderBy('name', 'desc');
        } else {
            return $query->orderBy('created_at', 'desc');
        }
    }

    public function scopeInStock($query)
    {
        return $query->where('in_stock', true);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('in_stock', false);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
