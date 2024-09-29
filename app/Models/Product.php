<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use URL;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'item_code',
        'keywords',
        'description',
        'category_id',
        'brand_id',
        'tax_id',
    ];

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id')->with('attribute_value');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttr::class, 'product_id', 'id')->with('images');
    }

    protected function Image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => URL::to(''.$value.'')
        );
    }
}
