<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ypk;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $products = Product::paginate(5);
        return view("index", [
            "products" => $products,
        ]);
    }
}
