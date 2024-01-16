<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Mail\OrderShipped;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', [App\Http\Controllers\OrderShippedController::class, 'index']);

Route::post('/sendMail', [App\Http\Controllers\OrderShippedController::class, 'sendMail'])->name('sendmail');
Route::post('/test-mail', [App\Http\Controllers\testMailController::class, 'testMail'])->name('testmail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
