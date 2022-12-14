<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'icon'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    public function getIconAttribute($value)
    {
        return $value ? $value : asset('/images/icons/' . $this->slug . '.png');
    }

    public function getName2Attribute()
    {
        if (strpos($this->name, 'women') !== false) {
            return 'women';
        }

        if (strpos($this->name, 'men') !== false) {
            return 'men';
        }

        return $this->name;
    }
}
