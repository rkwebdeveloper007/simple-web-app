<?php 

namespace App\Repositaries;
use Illuminate\Support\Facades\Hash;
use App\Model\Product;
use DB;

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

         return Product::paginate(20);

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        } 
    }

    public function selectedDelete($ids){
        try {

            DB::table("products")->whereIn('id',$ids)->delete();
            return response()->json(
                ['success'=>"Products Deleted successfully."]
            );

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        }
    }

    public function delete($id){
        try {

            Product::where('id',$id)->delete();
            return response()->json(
                ['success'=>"Products Deleted successfully."]
            );

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        }
    }


    public function update($request){
        try {
            
            
        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        }

    }



}