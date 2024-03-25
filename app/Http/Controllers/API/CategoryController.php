<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        if($category) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ]);
        }
    }

    public function allcategory()
    {
        $category = Category::where('status', '0')->get();
        $product = Product::all();
        if($category) {
            return response()->json([
                'status' => 200,
                'data' => [
                    'category' => $category,
                    'product' => $product
                ]
            ]);
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'No category found'
            ]);
        }
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meta_title' => 'required',
            'slug' => 'required',
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'validation_errors' => $validator->messages(),
            ]);
        }else {

            $category = new Category;
            $category->meta_title = $request->input('meta_title');
            $category->meta_keyword = $request->input('meta_keyword');
            $category->meta_description =$request->input('meta_description');
            $category->slug = $request->input('slug');
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == true ? '1' : '0';
            $category->save();
            return response()->json([
                'status' => 200,
                'message' => 'Category saved successfully',
                'data' => $category
            ]);
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if($category) {
            return response()->json([
                'status' => 200,
                'category' => $category
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No category ID found"
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($category) {
            $category->meta_title = $request->meta_title;
            $category->meta_keyword = $request->meta_keyword;
            $category->meta_description = $request->meta_description;
            $category->slug = $request->slug;
            $category->name = $request->name;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->save();
            
        }

        if($category) {
            return response()->json([
                'status' => 200,
                'message' => 'Category updated successfully'
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No category ID found, please check and try again.'
            ]);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        if($category) {
            return response()->json([
                'ststus' => 200,
                'message' => 'Category deleted successfully'
            ]);
        }else{
            return response()->json([
                'ststus' => 404,
                'message' => 'The category is not found.'
            ]);
        }
    }
}


