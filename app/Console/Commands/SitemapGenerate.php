<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

#[Signature('sitemap:generate')]
#[Description('Generate sitemap')]
class SitemapGenerate extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Sitemap::create()
            ->add(config("app.url"))
            ->add(Url::create("/home")
                ->setLastModificationDate(Carbon::yesterday()))
            ->add(Url::create(route("about_us")))
            ->add(Product::all())
            ->writeToFile(public_path("sitemap.xml"));

//        "about_us"
//            |> route(...)
//            |> Url(...)
//            |> Sitemap::create()
//            ->add(config("app.url"))
//            ->add(Url::create("/home")
//                ->setLastModificationDate(Carbon::yesterday()))(...)
//             ->add(Product::all())
//            ->writeToFile(public_path("sitemap.xml"));
    }
}
