<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\testMail;

class testMailController extends Controller
{
    public function testMail()
    {
        mail::to('johndoe@gmail.com')->sent(new testMail);
    }
}
