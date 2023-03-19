<?php

use App\Http\Controllers\hashingcontroller;
use App\Http\Controllers\uploadcontroller;
use App\Http\Controllers\checkfilecontroller;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[checkfilecontroller::class,'viewcheckfile'])->name('index');
Route::get('/File/Upload', function () {return view('uploadfile');});


//get hash code using ajax
Route::get('/HashCode', function () {return view('gethashcode');});


Route::get('/Check',[checkfilecontroller::class,'checkfileaunthenticity'])->name('proceed.check');


//post new file
Route::post('/upload',[uploadcontroller::class,'uploadfile'])->name('file.upload');