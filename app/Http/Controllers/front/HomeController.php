<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // use here use active as inner scope in product model
        $products = Product::active()->limit(8)->get();
        return view('front.home',compact('products'));
    }
}
