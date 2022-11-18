<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as H;
use App\Http\Controllers\CategoryController as C;
use App\Http\Controllers\BookController as B;

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

Auth::routes();
Route::get('/', [H::class, 'homeList'])->name('home')->middleware('gate:home');

Route::prefix('category')->name('c_')->group(function () {
    Route::get('/', [C::class, 'index'])->name('index');
    Route::get('/create', [C::class, 'create'])->name('create');
    Route::post('/create', [C::class, 'store'])->name('store');
    Route::get('/show/{category}', [C::class, 'show'])->name('show');
    Route::delete('/delete/{category}', [C::class, 'destroy'])->name('delete');
    Route::get('/edit/{category}', [C::class, 'edit'])->name('edit');
    Route::put('/edit/{category}', [C::class, 'update'])->name('update');
});

Route::prefix('book')->name('b_')->group(function () {
    Route::get('/', [B::class, 'index'])->name('index');
    Route::get('/create', [B::class, 'create'])->name('create');
    Route::post('/create', [B::class, 'store'])->name('store');
    Route::get('/show/{book}', [B::class, 'show'])->name('show');
    Route::delete('/delete/{book}', [B::class, 'destroy'])->name('delete');
    Route::get('/edit/{book}', [B::class, 'edit'])->name('edit');
    Route::put('/edit/{book}', [B::class, 'update'])->name('update');
});
