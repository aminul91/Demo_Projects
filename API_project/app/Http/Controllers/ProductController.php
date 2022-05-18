<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator;

class ProductController extends Controller
{
    
    public function addProducts(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'products.*.product_name'=>'required|unique:products',
                'products.*.product_price'=>'required',
                'products.*.product_category'=>'required',
            ];

            $customMessage = [
                'products.*.product_name.required'=>'Product is required',
                'products.*.product_price.required'=>'Product Price is required',
                'products.*.product_category.required'=>'Products Category is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            foreach($data['products'] as $addproduct){                
                $product = new Product();
                $product->product_name = $addproduct['product_name'];
                $product->product_price = $addproduct['product_price'];
                $product->product_category = $addproduct['product_category'];
                $product->save();
                $message = 'Products successfully added';
            }           
            return response()->json(['message'=>$message], 201);
        }        
    }

    public function updateProducts(Request $request, $id)
    {
        if ($request->ismethod('put')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'product_name'=>'required|unique:products',
                'product_price'=>'required',
                'product_category'=>'required',
            ];

            $customMessage = [
                'product_name.required'=>'Product is required',
                'product_price.required'=>'Product Price is required',
                'product_category.required'=>'Products Category is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
             
                $product = Product::findOrFail($id);
                $product->product_name = $data['product_name'];
                $product->product_price = $data['product_price'];
                $product->product_category = $data['product_category'];
                $product->save();
                $message = 'Products successfully updated';       
                return response()->json(['message'=>$message], 202);
        }        
    }

    public function updateSingleDataProducts(Request $request, $id)
    {
        if ($request->ismethod('patch')) {
            $data = $request->all();
            // return $data;

            $rules = [
                'product_name'=>'required|unique:products',
            ];

            $customMessage = [
                'product_name.required'=>'Product is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
             
                $product = Product::findOrFail($id);
                $product->product_name = $data['product_name'];
                $product->save();
                $message = 'Products Name successfully updated';       
                return response()->json(['message'=>$message], 202);
        }        
    }

    public function deleteProducts($id=null){
        Product::findOrFail($id)->delete();
        $message = 'Products successfully deleted';       
        return response()->json(['message'=>$message], 200);
    }

    public function deleteProductsJson(Request $request){
        if($request->isMethod('delete')){
            $data = $request->all();
            Product::where('id', $data['id'])->delete();
            $message = 'Products successfully deleted';       
            return response()->json(['message'=>$message], 200);
        }
    }

    public function deleteMultipleProducts($ids) {
        $ids = explode(',', $ids);
        Product::whereIn('id',$ids)->delete();
        $message = 'Multiple Products successfully deleted';       
        return response()->json(['message'=>$message], 200);
    }

    public function deleteMultipleProductsJson(Request $request){
        if($request->isMethod('delete')){
            $data = $request->all();
            Product::whereIn('id', $data['ids'])->delete();
            $message = 'Multiple Products successfully deleted';       
            return response()->json(['message'=>$message], 200);
        }
    }
}
