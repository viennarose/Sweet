<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CakeOrderController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\CakeCategoryController;


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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/categories', [ CakeCategoryController::class, 'index']);

});
Route::middleware(['auth', 'role:admin|user'])->group(function(){
    Route::get('/orders', [CakeOrderController::class, 'index']);
    Route::get('/orders', [CakeOrderController::class, 'userOnly']);
    Route::get('/orders/{id}', [CakeOrderController::class, 'showOrder']);
});
