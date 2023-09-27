<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/buku', [BukuController::class, 'index'])->name("buku");
Route::post('/buku', [BukuController::class, 'store'])->name('bukus.store');
Route::get('/buku/create', [BukuController::class, 'create'])->name('bukus.create');
Route::post('/buku/{buku}', [BukuController::class, 'update'])->name('bukus.update');
Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])->name('bukus.destroy');
Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])->name('bukus.edit');
