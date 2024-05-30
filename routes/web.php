<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

        Route::get('/trangchu', [PageController::class,
        'getIndex'])->name('trangchu');
        Route::get('loaisanpham/{type}', [PageController::class,
        'getloaisp'])->name('loaisanpham');
        Route::get('chitietsanpham/{id}', [PageController::class,
        'getchitietsp'])->name('chitietsanpham');
        Route::get('getlienhe', [PageController::class,
        'getlienhe'])->name('lienhe');
        Route::get('gioithieu', [PageController::class,
        'getgioithieu'])->name('gioithieu');
        Route::get('addtocart/{id}', [PageController::class,
        'getaddtocart'])->name('themgiohang');
        Route::get('deletecart/{id}', [PageController::class,
        'getdeletecart'])->name('xoagiohang');
        Route::get('reducebyone/{id}', [PageController::class, 
        'getReduceByOne'])->name('giammot');
        Route::get('dathang', [PageController::class, 
        'getdathang'])->name('dathang');
        Route::post('dathang', [PageController::class, 
        'postdathang'])->name('dathang');
        Route::get('dangnhap', [PageController::class, 
        'getlogin'])->name('dangnhap');
        Route::post('dangnhap', [PageController::class, 
        'postlogin'])->name('dangnhap');
        Route::get('dangky', [PageController::class, 
        'getsignup'])->name('dangky');
        Route::post('dangky', [PageController::class, 
        'postsignup'])->name('dangky');
        Route::get('dangxuat', [PageController::class, 
        'getlogout'])->name('dangxuat');
        Route::get('timkiem',[pageController::class,
        'getsearch'])->name('timkiem');
        