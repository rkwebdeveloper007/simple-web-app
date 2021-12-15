<?php 

namespace App\Repositaries;
use Illuminate\Support\Facades\Hash;
use App\Model\Product;
use DB;

class storeProductRepository {
    /**
     * Store product
     * image name as upc (unique product code)
     */
    public function store($request){
        try {

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

    /**
     * All products
     */
    public function all(){
        try {

         return Product::paginate(20);

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        } 
    }

    /**
     * Deleted selected ids products
     */
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

     /**
     * Deleted specific id product
     * Note: we can unlink product images while updating product
     */
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

    /**
     * Update Product
     * Note: we can unlink product images while updating product
     */
    public function update($request){
        try {
            if($request->hasFile('image')){
                $image = $request['upc'].'.'.$request['image']->extension();  
                $request['image']->move(public_path('admin/images/product_images'), $image);
            } else {
                $image = $request->old_image;
            }

            $product = Product::find($request->id);
            $product->name      = $request['name'];
            $product->price     = $request['price'];
            $product->upc       = $request['upc'];
            $product->status    = $request['status'];
            $product->image     = $image;
            $product->save();

            return redirect()->route('admin.addProduct')->with('status', 'Product update Successfully');

        } catch (\Exception $e) {
            info($e->getMessage().'-'.$e->getLine());
        }

    }



}