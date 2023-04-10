<?php

use App\Http\Controllers\hashingcontroller;
use App\Http\Controllers\uploadcontroller;
use App\Http\Controllers\checkfilecontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\reportcontroller;
use App\Http\Controllers\export;
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
Route::get('/', [checkfilecontroller::class,'viewcheckfileasguest'])->name('index');
Route::get('/viewReport',[reportcontroller::class,'viewreport']);

Route::get('/Dashboard', [checkfilecontroller::class,'dashboardview']);
Route::get('/Check/File',[checkfilecontroller::class,'viewcheckfile'])->name('checkfile');
Route::get('/File/Upload', function () {return view('uploadfile');});

Route::get('/Export/Report',[export::class,'exportreports'])->name('direct.export');
Route::get('/Sort/Report',[checkfilecontroller::class,'sortreportsdashboard'])->name('sort.export');



//get hash code using ajax
Route::get('/HashCode', function () {return view('gethashcode');});
Route::post('/Check',[checkfilecontroller::class,'checkfileaunthenticity'])->name('proceed.check');


//post new file
Route::post('/upload',[uploadcontroller::class,'uploadfile'])->name('file.upload');
Route::get('/File/Delete',[uploadcontroller::class,'filedelete'])->name('file.delete');

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
Route::get('/Process/Team',[usercontroller::class,'processdelete'])->name('team.delete');


//Categories
Route::get('/Categories', function () {return view('category');});
Route::post('/Create/Category',[usercontroller::class,'addnewcategory'])->name('category.new');


//profile
Route::get('/Profile',function () {return view('profile');})->name('profile');
Route::post('/Change/Password',[usercontroller::class,'pwchange'])->name('pw.change');
Route::get('/Categ/Delete',[usercontroller::class,'categorydelete'])->name('categ.delete');

//flus
Route::get('/Logout',[usercontroller::class,'logout']);


