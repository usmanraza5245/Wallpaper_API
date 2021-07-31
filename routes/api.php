<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\galleryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('add_category',[categoryController::class, 'store']);
Route::get('category', [categoryController::class, 'index']);


Route::post('add_gallery',[galleryController::class, 'store']);
Route::get('gallery/{id?}', [galleryController::class, 'index']);

Route::get('AllGallery', [galleryController::class, 'getAll']);