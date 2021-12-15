<?php 

namespace App\Repositaries;
use Illuminate\Support\Facades\Hash;
use App\Model\Product;

class storeProductRepository {

    public function store($request){
        try {

            //image name as upc unique product code
            $image = $request['upc'].'.'.$request['image']->extension();  
            $request['image']->move(public_path('admin/images/product_images'), $image);

            $product = new Product;
            $product->name      = $request['name'];
            $product->price     = $request['price'];
            $product->upc       = $request['upc'];
            $product->status    = $request['status'];
            $product->image     = $image;
            $product->save();

            return redirect()->route('admin.addProduct')->with('status', 'Product added Successfully');

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        } 
    }


    public function all(){
        try {

            //fetching prodcts with condition
            $products = Product::paginate(20);
            return $products;

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        } 
    }



}