<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_price_dollar' => 'boolean',
        'price_property' => 'float',
        'lat' => 'float',
        'lng' => 'float',
        'price_usd_m2' => 'float',
        'price_ars_m2' => 'float',
        'price_hidden' => 'boolean',
        'active' => 'boolean',
    ];

    public function properties()
    {
        return $this->hasMany(Image::class);
    }
}
