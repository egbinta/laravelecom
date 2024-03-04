<?php

namespace App\Http\Controllers\API;

use App\Models\Testpro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function index()
    {
        $testPro = Testpro::all();
        if($testPro) {
            return response()->json([
                'status' => 200,
                "testpro" => $testPro
            ]);
        }else{
            return response()->json([
                'status' => 404,
                "message" => "Product not found"
            ]);
        }
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            "proname" => "required",
            "proprice" => "required",
            "prodescription" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => 422,
                "error" => $validator->messages()
            ]);
        }else{
            $file = $request->file('image');
            $fileName = time().$file->getClientOriginalName();
            $file->move('uploads/testpro/', $fileName);
            $testProduct = Testpro::create([
                "proname" => $request->input('proname'),
                "proprice" => $request->input('proprice'),
                "prodescription" => $request->input('prodescription'),
                "image" => 'uploads/testpro/' . $fileName
            ]);

            if($testProduct) {
                return response()->json([
                    'status' => 200,
                    "message" => "Product save successfully"
                ]);
            }
        }
    }

    public function edit($id)
    {
        $testPro = Testpro::find($id);
        if($testPro) {
            return response()->json([
                'status' => 200,
                "tetspro" => $testPro
            ]);
        }else{
            return response()->json([
                'status' => 404,
                "message" => "Product not found"
            ]);
        }
    }

    public function update(Request $request, $id) 
    {
        $testPro = Testpro::find($id);
        if($testPro) {
            if($request->hasFile('image')) {
                $path = $testPro->image;
                if(File::exists($path)) {
                    File::delete($path);
                }
                
                $file = $request->file('image');
                $fileName = time().$file->getClientOriginalName();
                $file->move('uploads/testpro/', $fileName); 
            }
            

            $testPro->proname = $request->input('proname');
            $testPro->proprice = $request->input('proprice');
            $testPro->prodescription = $request->input('prodescription');
            $testPro->image = "uploads/testpro/".$fileName;
            $testPro->save();

            return response()->json([
                "status" => 200,
                "message" => "Product update successfully",
            ]);
                        
        }else {
            return response()->json([
                "status" => 404,
                "message" => "Product not found"
            ]);
        }        
    }
}
