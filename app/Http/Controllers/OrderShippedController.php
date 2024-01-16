<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class OrderShippedController extends Controller
{
    public function index(Request $request)
    {
        return view('testMail/ordershipped');
    }

    public function sendMail(Request $request)
    {
        $order = [
            "title" => "Test mail from orderShiped",
            "body" => $request->input('message')
        ];
        
        mail::to($request->input('mail'))->send(new OrderShipped($order));

        return redirect()->back()->with('message', 'mail sent successfully');
        
    }
}
