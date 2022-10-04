<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\UploadController;
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

//route filepond
Route::controller(UploadController::class)->group(function () {
    Route::post('/upload', 'store')->name('upload');
    Route::delete('/hapus', 'destroy')->name('hapus');
});

//image controller
Route::controller(ImageController::class)->group(function () {
    Route::get('image', 'index')->name('index.image');
    Route::post('/images', 'store')->name('submit');
    Route::delete('/images/{id}', 'destroy')->name('delete.image');
});
