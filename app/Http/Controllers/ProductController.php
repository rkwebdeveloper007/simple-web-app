<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productView(){

        return view('admin.product-lists');
        
    }


    public function addProduct(){
        return view('admin.store-product');
    }


    public function storeProducts(Request $request){
        dd("hii");
    }
}
