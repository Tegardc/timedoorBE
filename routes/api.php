<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('brands', BrandsController::class);
    Route::apiResource('category', CategoryController::class);
    // Route::get('/user', function (Request $request) {
    //     return $request->user();

    // });




    // Route::get('/products', [ProductsController::class, 'index'])->name('product.index');
    // Route::get('/products/{id}', [ProductsController::class, 'show'])->name('product.show');
    // Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
    // Route::put('/products/{id}', [ProductsController::class, 'update'])->name('product.update');
    // Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('product.destroy');
});
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'regis'])->name('regis');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout')->middleware(middleware: 'auth:sanctum');


// Route::get('brands', [BrandsController::class, 'index'])->name('brands.index');
// Route::get('brands/{id}', [BrandsController::class, 'show'])->name('brands.show');
// Route::post('brands', [BrandsController::class, 'store'])->name('brands.store');
// Route::put('brands/{id}', [BrandsController::class, 'update'])->name('brands,update');
// Route::delete('brands/{id}', [BrandsController::class, 'destroy'])->name('brands.destroy');
// Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
// Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category,show');
// Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
// Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category,update');
// Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category,destroy');
