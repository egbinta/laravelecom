<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Testpro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestProductController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proname' => 'required',
            'propricr' => 'required',
            'prodescription' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => 422,
                "error" => $validator->messages()
            ]);
        }else{
            // $file = $request->file('image');
            // $fileName = time(). $file->getClientOriginalName();
            // $file->move("uploads/testpro/", $fileName);

            // $product = Testpro::create([
            //     "proname" => $request->proname,
            //     "proprice" => $request->proprice,
            //     "prodescription" => $request->prodescription,
            //     "image" => "uploads/testpro/" . $fileName
            // ]);

            // if($product) {
            //     return response()->json([
            //         'status' => 200,
            //         'message' => "Test product saved successfully"
            //     ]);
            // }
        }
    }
}
