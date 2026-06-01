<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
    private function addAllPages(Sitemap $sitemap): void
    {
        $staticPages = [
            ['url' => config('app.url'), 'priority' => 1.0, 'changefreq' => Url::CHANGE_FREQUENCY_DAILY],
            ['url' => '/home', 'priority' => 0.8, 'changefreq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['url' => '/about_us', 'priority' => 0.5, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => '/user/detail', 'priority' => 0.3, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => '/user/edit', 'priority' => 0.3, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => '/feedback', 'priority' => 0.6, 'changefreq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['url' => '/feedback/create', 'priority' => 0.4, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => '/favourite', 'priority' => 0.3, 'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
        ];

        foreach ($staticPages as $page) {
            $tag = Url::create($page['url'])
                ->setChangeFrequency($page['changefreq'])
                ->setPriority($page['priority']);

            if ($page['url'] === '/home') {
                $tag->setLastModificationDate(Carbon::yesterday());
            }

            $sitemap->add($tag);
        }

        Product::all()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(
                Url::create("/product/{$product->id}")
                    ->setLastModificationDate($product->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.6),
            );
        });
    }

    private function generateForJavaScript(): void
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->formatOutput = true;

        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute('xmlns:xhtml', 'http://www.w3.org/1999/xhtml');
        $urlset->setAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');
        $urlset->setAttribute('xmlns:video', 'http://www.google.com/schemas/sitemap-video/1.1');
        $urlset->setAttribute('xmlns:news', 'http://www.google.com/schemas/sitemap-news/0.9');
        $dom->appendChild($urlset);

        $appendUrl = function (string $url, string $title, int $minRole) use ($dom, $urlset) {
            $urlEl = $dom->createElement('url');
            $locEl = $dom->createElement('loc', $url);
            $titleEl = $dom->createElement('title', $title);
            $roleEl = $dom->createElement('min_role', (string) $minRole);
            $urlEl->appendChild($locEl);
            $urlEl->appendChild($titleEl);
            $urlEl->appendChild($roleEl);
            $urlset->appendChild($urlEl);
        };

        $baseUrl = config('app.url');

        $staticPages = [
            ['url' => $baseUrl, 'title' => 'Главная страница', 'role' => 0],
            ['url' => $baseUrl . '/home', 'title' => 'Профиль', 'role' => 1],
            ['url' => $baseUrl . '/about_us', 'title' => 'О нас', 'role' => 0],
            ['url' => $baseUrl . '/user/detail', 'title' => 'Мои данные', 'role' => 1],
            ['url' => $baseUrl . '/user/edit', 'title' => 'Редактировать профиль', 'role' => 1],
            ['url' => $baseUrl . '/feedback', 'title' => 'Отзывы', 'role' => 1],
            ['url' => $baseUrl . '/feedback/create', 'title' => 'Оставить отзыв', 'role' => 1],
            ['url' => $baseUrl . '/favourite', 'title' => 'Избранное', 'role' => 1],
            ['url' => $baseUrl . '/order_management', 'title' => 'Управление заявками', 'role' => 2],
            ['url' => $baseUrl . '/product', 'title' => 'Управление продуктами', 'role' => 2],
            ['url' => $baseUrl . '/product/create', 'title' => 'Добавить продукт', 'role' => 2],
            ['url' => $baseUrl . '/product/edit_page', 'title' => 'Выбор продукта для редактирования', 'role' => 2],
            ['url' => $baseUrl . '/user_management', 'title' => 'Управление пользователями', 'role' => 3],
            ['url' => $baseUrl . '/user_management/create', 'title' => 'Добавить пользователя', 'role' => 3],
        ];

        foreach ($staticPages as $page) {
            $appendUrl($page['url'], $page['title'], $page['role']);
        }

        Product::all()->each(function (Product $product) use ($appendUrl, $baseUrl) {
            $appendUrl($baseUrl . "/product/{$product->id}", $product->product_name, 0);
            $appendUrl($baseUrl . "/product/{$product->id}/edit", $product->product_name . ' (ред.)', 2);
            $appendUrl($baseUrl . "/order/create/{$product->id}", 'Заказать ' . $product->product_name, 1);
        });

        Order::all()->each(function (Order $order) use ($appendUrl, $baseUrl) {
            $appendUrl($baseUrl . "/order/{$order->id}", 'Заказ #' . $order->id, 1);
        });

        User::all()->each(function (User $user) use ($appendUrl, $baseUrl) {
            $appendUrl($baseUrl . "/user_management/{$user->id}/edit", $user->name . ' (ред.)', 3);
        });

        $dom->save(public_path('search.xml'));
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $sitemap = Sitemap::create();
        $this->addAllPages($sitemap);
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->generateForJavaScript();
    }
}
