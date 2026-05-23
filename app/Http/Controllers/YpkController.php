<?php

namespace App\Http\Controllers;

use App\Models\Ypk;
use App\Http\Requests\StoreYpkRequest;
use App\Http\Requests\UpdateYpkRequest;
use Illuminate\Http\Request;

class YpkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreYpkRequest $request)
    {
        Ypk::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Ypk $ypk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ypk $ypk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateYpkRequest $request, Ypk $ypk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Ypk::findOrFail($request->ypk_id)->delete();
        return back();
    }
}
