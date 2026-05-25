<?php
/**
 * Контроллер главной страницы.
 *
 * Отвечает за отображение каталога товаров и услуг на главной странице сайта.
 */

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ypk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * Показать главную страницу со списком товаров/услуг.
     *
     * Выводит последние добавленные товары и услуги с пагинацией.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('user', 'ypk', 'statusProduct')
            ->orderByDesc('created_at')
            ->paginate(5);

        $favoritedProductIds = [];
        if (Auth::check()) {
            $favoritedProductIds = Auth::user()->favourite()->pluck('product_id')->all();
        }

        return view("index", [
            "products" => $products,
            "favoritedProductIds" => $favoritedProductIds,
        ]);
    }
}
