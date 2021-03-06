<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Repositaries\storeProductRepository;
use App\Model\Product;

class ProductController extends Controller
{
    private $storeProductRepository;

    public function __construct(storeProductRepository $storeProductRepository){

        $this->storeProductRepository = $storeProductRepository;

    }


    public function products(){

        $products = $this->storeProductRepository->all();
        return view(
            'admin.product-lists',
            [
                'products'=>$products
            ]
        );   
    }


    public function storeProducts(StoreProductRequest $request){

        return $this->storeProductRepository->store($request);
 
     }


    public function addProduct(){

        return view('admin.store-product');

    }


    public function selectedProductsDelete(Request $request){

        return $this->storeProductRepository->selectedDelete(explode(",",$request->ids));
    }

    
    public function findById($id){

        $product = Product::findorfail($id);
        return view(
            'admin.update-product',
            [
                'data' => $product
            ]
        );

    }
    
    public function update(Request $request){

        return $this->storeProductRepository->update($request);

    }

    public function destory($id){

        return $this->storeProductRepository->delete($id);

    }

    
}

