<?php

namespace App\Http\Controllers;

use App\Models\Ypk;
use App\Http\Requests\StoreYpkRequest;
use App\Http\Requests\UpdateYpkRequest;
use Illuminate\Http\Request;

class YpkController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * Сохранить новую категорию товаров/услуг.
     *
     * @param StoreYpkRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreYpkRequest $request)
    {
        Ypk::create($request->all());

        return back();
    }

    public function show(Ypk $ypk)
    {
        //
    }

    public function edit(Ypk $ypk)
    {
        //
    }

    public function update(UpdateYpkRequest $request, Ypk $ypk)
    {
        //
    }

    /**
     * Удалить категорию товаров/услуг.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Ypk::findOrFail($request->ypk_id)->delete();

        return back();
    }
}
