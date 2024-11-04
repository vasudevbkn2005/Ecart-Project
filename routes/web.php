<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session as FacadesSession;

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

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
//     Route::get('/admin/manage-users', [AdminController::class, 'index']);
// });
// Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('auth.redirect');
Route::get('/login', function () {
    return view('login'); // return your login view here
})->name('login');

Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/product/dashboard', [ProductController::class, 'dashboard'])->name('product.dashboard');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    // Add other admin routes here
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/logout', function () {
    FacadesSession::forget('user');
    return redirect('/');
});
Route::view('/register', 'register');
// Route::post("/login",[UserController::class,'login']);
// // Route::view('/login', 'login');
// Route::post("/register", [UserController::class, 'register']);
Route::get("/", [ProductController::class, 'index']);
Route::get("detail/{id}", [ProductController::class, 'detail']);
Route::get("search", [ProductController::class, 'search']);
Route::post("add_to_cart", [ProductController::class, 'add']);
Route::get("/cartlist", [ProductController::class, 'cart']);
Route::get("/removeCart/{id}", [ProductController::class, 'remove']);
Route::get("/order", [ProductController::class, 'order']);
Route::post("/orderplace", [ProductController::class, 'orderplace']);
Route::get("/myorders", [ProductController::class, 'myorder']);