<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sku',
        'mrp',
        'price',
        'qty',
        'length',
        'breadth',
        'height',
        'weight'
    ];

    public function images()
    {
        return $this->hasMany(ProductAttrImage::class, 'product_attr_id', 'id');
    }

    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function size()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
}
