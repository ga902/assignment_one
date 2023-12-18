<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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
    $to_name ="test";
    $to_email="ganesh.hurgule@gmail.com";
    $data =array('name'=>'test','body'=>'test email'  );
    Mail::send('emails.sample',$data,function($message) use($to_name,$to_email){
        $message->to($to_email)
        ->subject('test');
    });
    echo"Email Has Been send";
});
Route::resource('student',StudentController::class);
Route::get('getIds',[StudentController::class,'fetchIds']);
Route::get('getCityState',[StudentController::class,'getCityState']);
Route::get('sendEmail',[StudentController::class,'sendEmail']);