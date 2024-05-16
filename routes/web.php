<?php

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

Route::get('/',[App\Http\Controllers\HomePageController::class, 'index']);

Route::get('/about',[App\Http\Controllers\HomePageController::class, 'about']);

Route::get('/kontak',[App\Http\Controllers\HomePageController::class, 'kontak']);

Route::get('/kategori', [\App\Http\Controllers\HomepageController::class, 'kategori']);


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin');


      //Tambahan route package kategori
      Route::resource('/kategori', \App\Http\Controllers\KategoriController::class);

      //Tambahan route package Produk
      Route::resource('/produk', \App\Http\Controllers\ProdukController::class);
  
      //Tambahan route package Customer
      Route::resource('/customer', \App\Http\Controllers\CustomerController::class);

      // image
      Route::get('image', [\App\Http\Controllers\ImageController::class, 'index'])->name('image.index');
      // simpan image
      Route::post('image', [\App\Http\Controllers\ImageController::class, 'store'])->name('image.store');
      // hapus image by id
      Route::delete('image/{id}', [\App\Http\Controllers\ImageController::class, 'destroy'])->name('image.destroy');




     // upload image kategori
     Route::post('imagekategori', [\App\Http\Controllers\KategoriController::class, 'uploadimage']);
     // hapus image kategori
     Route::post('imagekategori/{id}', [\App\Http\Controllers\KategoriController::class, 'deleteimage']);

});





// Route::get('/aboutus', function () {
//     return view('welcome');
// });

// Route::get('/halo', function () {
//     return "Hallo Saya Risal Mutaqin";
// });

// Route::get('/latihan', [App\Http\Controllers\LatihanController::class, 'index']);

// Route::get('/beranda', [App\Http\Controllers\LatihanController::class, 'beranda']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
