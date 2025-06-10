<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\ProductController;

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

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products/validate-step', [ProductController::class, 'validateStep'])->name('products.validate-step');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

Route::get('/', function () {
    return view('welcome');
});