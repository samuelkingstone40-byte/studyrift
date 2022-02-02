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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('upload', [App\Http\Controllers\ClientController::class, 'sell']);
Route::post('post-document',[App\Http\Controllers\ClientController::class,'post_document']);
Route::get('uploads',[App\Http\Controllers\ClientController::class,'uploads'])->name('uploads');
Route::get('profile',[App\Http\Controllers\ClientController::class,'profile'])->name('profile');
Route::get('upload-files/{id}',[App\Http\Controllers\ClientController::class,'upload_files'])->name('upload-files');
Route::post('/uploadFile', [App\Http\Controllers\ClientController::class, 'uploadFile'])->name('uploadFile');

Route::get('browse-files', [App\Http\Controllers\PublicController::class,'documents']);
Route::get('document-preview/{slug}', [App\Http\Controllers\PublicController::class,'document_preview']);
Route::get('cart', [App\Http\Controllers\PublicController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [App\Http\Controllers\PublicController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [App\Http\Controllers\PublicController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [App\Http\Controllers\PublicController::class, 'remove'])->name('remove.from.cart');
