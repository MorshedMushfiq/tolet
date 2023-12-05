<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $all_products = Product::all();
        return view('frontend.index', compact('all_products'));
    }

    public function singleProduct($id){
        $singleProduct = Product::find($id);
        return view('frontend.single_product', compact('singleProduct'));
    }

}
