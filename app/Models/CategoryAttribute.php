<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    use HasFactory;

    protected $table = 'category_attributes';

    protected $fillable = [
        'category_id',
        'attribute_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'attribute_id');
    }
}
