<?php

namespace App\Console\Commands;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use App\Models\Property;
use Carbon\Carbon;
use App\Http\Controllers\ImageController;

use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $properties = Property::all();
        // modify this to your own needs
        $sitemap = SitemapGenerator::create(config('app.url'))
            ->maxTagsPerSitemap(20000)
            ->getSitemap()
        ->add(Url::create(route('inmuebles'))
            ->setLastModificationDate(Carbon::create('2024', '7', '10'))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8))
        ->add(Url::create(route('contacto'))
            ->setLastModificationDate(Carbon::create('2024', '7', '10'))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.8))

        ->add($properties);

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
