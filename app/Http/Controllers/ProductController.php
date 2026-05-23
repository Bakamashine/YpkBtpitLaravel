<?php

namespace App\Http\Controllers;

use App\Contracts\IImageService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\StatusProduct;
use App\Models\Ypk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{



    public function __construct(private IImageService $imageService)
    {
    }
    public function index()
    {
        //
    }

    public function create()
    {
        $ypks = Ypk::all();
        $statusProducts = StatusProduct::all();

        return view('products.create', compact('ypks', 'statusProducts'));
    }

    public function edit_page()
    {

        $orders = Order::orderByDesc('created_at')->paginate(6);
        $products = Product::orderByDesc('created_at')->paginate(6);
        return view('products.edit_page', compact('orders', 'products'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('photo_path')) {
            // $data['photo_path'] = $request->file('photo_path')->store('products', 'public');
            $data['photo_path'] = $this->imageService->uploadImage($request->file('photo_path'), 'products');
        }

        $request->user()->products()->create($data);

        return to_route('home');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $ypks = Ypk::all();
        $statusProducts = StatusProduct::all();

        return view('products.edit', compact('product', 'ypks', 'statusProducts'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $this
                ->imageService
                ->updateImage($request->file('photo_path'), 'products', $product->photo_path);
        }

        $product->update($data);

        return to_route('home');
    }

    public function destroy(Product $product)
    {
        $this->imageService->removeImage($product->photo_path);

        $product->delete();

        return to_route('home');
    }
}
