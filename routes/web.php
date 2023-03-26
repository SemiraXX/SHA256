<?php

use App\Http\Controllers\hashingcontroller;
use App\Http\Controllers\uploadcontroller;
use App\Http\Controllers\checkfilecontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\reportcontroller;
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

//Categories
Route::get('/', function () {return view('dashboard');});
Route::get('/viewReport',[reportcontroller::class,'viewreport']);



Route::get('/Check/File',[checkfilecontroller::class,'viewcheckfile'])->name('index');
Route::get('/File/Upload', function () {return view('uploadfile');});


//get hash code using ajax
Route::get('/HashCode', function () {return view('gethashcode');});
Route::get('/Check',[checkfilecontroller::class,'checkfileaunthenticity'])->name('proceed.check');


//post new file
Route::post('/upload',[uploadcontroller::class,'uploadfile'])->name('file.upload');


//login
Route::get('/Login', function () {return view('login');})->name('user');
Route::post('/Process/Login',[usercontroller::class,'loginproceed'])->name('user.login');


//Action Trail
Route::get('/Action/Trail', function () {return view('actiontrail');});


//Teams
Route::get('/Teams', function () {return view('team');});
Route::post('/Create/Team',[usercontroller::class,'addnewteam'])->name('team.new');
Route::get('/Edit/Team',[usercontroller::class,'editaccount'])->name('team.edit');
Route::post('/Process/Edit',[usercontroller::class,'processupdate'])->name('process.edit');
Route::get('/Delete/Team',[usercontroller::class,'deleteaccount'])->name('team.delete');
Route::get('/Process/Delete',[usercontroller::class,'processdelete'])->name('process.delete');

//Categories
Route::get('/Categories', function () {return view('category');});
Route::post('/Create/Category',[usercontroller::class,'addnewcategory'])->name('category.new');


//profile
Route::get('/Profile',function () {return view('profile');})->name('profile');

//flus
Route::get('/Logout',[usercontroller::class,'logout']);


