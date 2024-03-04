<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();

        if($product) {
            return response()->json([
                'status' => 200,
                'product' => $product
            ]);
        }else{
            return response()->json([
                'status' => 422,
                'message' => "Somthing went wrong please try again"
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'brand' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages(),
            ]);
        }else{
            $product = new Product();
            $product->category_id = $request->input('category_id');
            $product->slug = $request->input('slug');
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->meta_title = $request->input('meta_title');
            $product->meta_keyword = $request->input('meta_keyword');
            $product->meta_description = $request->input('meta_decription');
            $product->brand = $request->input('brand');
            $product->selling_price = $request->input('selling_price');
            $product->original_price = $request->input('original_price');
            $product->quantity = $request->input('quantity');

            $file = $request->file('image');
            $extension = time().$file->getClientOriginalName();
            $file->move('uploads/products/', $extension);
            $product->image = 'uploads/products/' . $extension;

            $product->featured = $request->input('featured') == true ? '1' : '0';
            $product->popular = $request->input('popular') == true ? '1' : '0';
            $product->status = $request->input('status') == true ? '1' : '0';
            
            $product->save();

            return response()->json([
                'status' => 200,
                'message' => 'Product has been saved successfully.',
                
            ]);
        }
    }

    public function edit($id)
    {
        $product = Product::where("id", $id)->first();
        if($product) {
            return response()->json([
                "status" => 200,
                "product" => $product
            ]);
        }else{
            return response()->json([
                "status" => 404,
                "message" => "Product Not Found"
            ]);
        }
    }   


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'slug' => 'required',
            'name' => 'required',
            'category_id' => 'required',
            'brand' => 'required',
            'quantity' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages(),
            ]);
        }else{
            $product = Product::find($id);
            if($product) {
                $product->category_id = $request->category_id;
                $product->slug = $request->slug;
                $product->name = $request->name;
                $product->description = $request->description;
                $product->meta_title = $request->meta_title;
                $product->meta_keyword = $request->meta_keyword;
                $product->meta_description = $request->meta_description;
                $product->brand = $request->brand;
                $product->selling_price = $request->selling_price;
                $product->original_price = $request->original_price;
                $product->quantity = $request->quantity;

                if($request->hasFile('image')) {
                    $path = $product->image;
                    if(File::exists($path)) {
                        File::delete($path);
                    }
                    $file = $request->file('image');
                    $extension = time().$file->getClientOriginalName();
                    $file->move('uploads/products/', $extension);
                    $product->image = 'uploads/products/' . $extension;
                }

                $product->featured = $request->featured;
                $product->popular = $request->popular;
                $product->status = $request->status;
                
                $product->save();

                return response()->json([
                    "status" => 200,
                    "message" => "The product has been updated successfully",
                ]);
            }else{
                return response()->json([
                    "status" => 404,
                    "message" => "PRODUCT NOT FOUND"
                ]);
            }
        }
    }
}
