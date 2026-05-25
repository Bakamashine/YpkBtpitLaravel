<?php
/**
 * Контроллер для управления товарами и услугами.
 *
 * Обрабатывает создание, просмотр, редактирование и удаление товаров/услуг.
 * Также предоставляет страницу редактирования для администратора с выводом заказов.
 */

namespace App\Http\Controllers;

use App\Contracts\IImageService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\StatusProduct;
use App\Models\Ypk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Конструктор с внедрением сервиса изображений.
     *
     * @param IImageService $imageService
     */
    public function __construct(private IImageService $imageService)
    {
    }

    /**
     * Показать список всех товаров/услуг (заглушка).
     */
    public function index()
    {
        //
    }

    /**
     * Показать страницу управления товарами/услугами (для администратора).
     *
     * @return \Illuminate\View\View
     */
    public function edit_page(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function (Builder $query, $search) {
            $query->whereLike('product_name', "%{$search}%")
                ->orWhereLike('address', "%{$search}%");
        })
            ->orderByDesc('created_at')
            ->paginate(6)
            ->withQueryString();

        return view('products.edit_page', compact('products'));
    }

    /**
     * Сохранить новый товар/услугу в базу данных.
     *
     * @param StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $this->imageService->uploadImage($request->file('photo_path'), 'products');
        }

        $request->user()->products()->create($data);

        return to_route('product.edit_page');
    }

    /**
     * Показать форму создания нового товара/услуги.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $ypks = Ypk::all();
        $statusProducts = StatusProduct::all();

        return view('products.create', compact('ypks', 'statusProducts'));
    }

    /**
     * Показать детальную информацию о товаре/услуге.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Показать форму редактирования товара/услуги.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $ypks = Ypk::all();
        $statusProducts = StatusProduct::all();

        return view('products.edit', compact('product', 'ypks', 'statusProducts'));
    }

    /**
     * Обновить товар/услугу в базе данных.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $this
                ->imageService
                ->updateImage($request->file('photo_path'), 'products', $product->photo_path);
        }

        $product->update($data);

        return to_route('product.edit_page');
    }

    /**
     * Удалить товар/услугу.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $this->imageService->removeImage($product->photo_path);
        $product->delete();

        return to_route('product.edit_page');
    }
}
