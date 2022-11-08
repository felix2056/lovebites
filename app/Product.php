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

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function currencyPrice()
    {
        return '$' . $this->price;
    }

    public function previous()
    {
        return Product::where('id', '<', $this->id)->latest('id')->first();
    }

    public function next()
    {
        return Product::where('id', '>', $this->id)->oldest('id')->first();
    }

    public function getFeaturedImageAttribute()
    {
        return '/storage/products/' . $this->attributes['featured_image'];
    }

    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }

    public function getMetaAttribute($value)
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
