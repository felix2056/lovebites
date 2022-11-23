<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon'
    ];

    protected $with = [
        'subcategories'
    ];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

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
}
