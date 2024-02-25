<?php

use App\Models\Producto;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Productos;

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

// ... (resto del código)

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/productos', \App\Http\Livewire\Productos::class)->name('productos.lista');
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});
