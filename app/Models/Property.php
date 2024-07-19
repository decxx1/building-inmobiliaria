<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
use App\Http\Controllers\ImageController;

class Property extends Model implements Sitemapable
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

    public function toSitemapTag(): Url | string | array
    {
        $sitemap = Url::create(route('inmuebles.show', $this->id))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            ->setPriority(0.2);
        $imageController = new ImageController();
        $imageCover = $imageController->getThumb($this->id, 1);
        $sitemap->addImage($imageCover, 'cover');
        for ($i = 2; $i <= 6; $i++) {
            $imagePath = $imageController->getThumb($this->id, $i);
            if (!empty($imagePath)) {
                $sitemap->addImage($imagePath, 'Image extra '.$i);
            }
        }

        return $sitemap;
    }
}
