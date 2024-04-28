<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('upload-attachment',[FileController::class,'store']);

// products
Route::get('products',[ProductController::class,'index']);
Route::post('products',[ProductController::class,'store']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::delete('products/{id}',[ProductController::class,'destroy']);
Route::put('products/{id}',[ProductController::class,'update']);

// categories
Route::get('categories',[CategoryController::class,'index']);
Route::post('categories',[CategoryController::class,'store']);
Route::get('categories/{id}',[CategoryController::class,'show']);
Route::delete('categories/{id}',[CategoryController::class,'show']);
Route::put('categories/{id}',[CategoryController::class,'update']);

// sub categories
Route::get('sub-categories',[SubCategoryController::class,'index']);
Route::post('sub-categories',[SubCategoryController::class,'store']);
Route::get('sub-categories/{id}',[SubCategoryController::class,'show']);
Route::delete('sub-categories/{id}',[SubCategoryController::class,'destroy']);
Route::put('sub-categories/{id}',[SubCategoryController::class,'update']);
