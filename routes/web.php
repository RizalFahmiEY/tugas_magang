<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Sesicontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function(){

Route::get('/',[Sesicontroller::class, 'index'])->name('login');
Route::post('/',[Sesicontroller::class, 'login']);
});

Route::get('/home',function(){
    return redirect('/admin');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/admin/operator',[AdminController::class,'operator'])->middleware('userAkses:operator');
    Route::get('/admin/keuangan',[AdminController::class,'keuangan'])->middleware('userAkses:keuangan');
    Route::get('/admin/marketing',[AdminController::class,'marketing'])->middleware('userAkses:marketing');

    Route::get('/logout',[Sesicontroller::class,'logout']);
});



