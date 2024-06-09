<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'image_id',
        'brand',
        'code',
        'description',
        'price_purchase',
        'price_sale',
        'price_wholesale',
        'term',
        'shipping',
        'warranty',
        'check_percentage',
        'percentage',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
    public function productImage()
    {
        return $this->belongsTo(ProductImage::class);
    }
    public function warehouse(){
        return $this->hasMany(Warehouse::class);
    }
}
