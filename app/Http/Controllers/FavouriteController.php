<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavouriteRequest;
use App\Http\Requests\UpdateFavouriteRequest;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $favourites = $request->user()->favourite()->with('product')->paginate(6);
        return view('user.favorite', compact('favourites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavouriteRequest $request)
    {
        $exists = $request->user()->favourite()
            ->where('product_id', $request->validated('product_id'))
            ->exists();

        if (!$exists) {
            $request->user()
                ->favourite()
                ->create($request->validated());
            return back();
        }

        return back(422)
            ->with("message", "Вы уже добавляли это в избранное");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Favourite $favourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavouriteRequest $request, Favourite $favourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Favourite::where("product_id", $product->id)->delete();
        return back();
    }
}
