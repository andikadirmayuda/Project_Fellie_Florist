<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\VariasiProdukController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes for Manager and Admin
    Route::middleware(['role:manager,admin'])->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('variasi', VariasiProdukController::class);
        Route::resource('inventaris', InventarisController::class);
        // Manager & Admin can manage users
        Route::resource('users', UserController::class);
    });
    
    // Additional routes for Kasir
    Route::middleware(['role:kasir'])->group(function () {
        Route::resource('inventaris', InventarisController::class)->only(['index', 'create', 'store']);
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.kasir.index');
        Route::get('/variasi', [VariasiProdukController::class, 'index'])->name('variasi.kasir.index');
    });
    
    // Routes for Karyawan
    Route::middleware(['role:karyawan'])->group(function () {
        Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.karyawan.index');
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.karyawan.index');
        Route::get('/variasi', [VariasiProdukController::class, 'index'])->name('variasi.karyawan.index');
    });
    
    // Routes for Pelanggan
    Route::middleware(['role:pelanggan'])->group(function () {
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.pelanggan.index');
        Route::get('/variasi', [VariasiProdukController::class, 'index'])->name('variasi.pelanggan.index');
    });
});

require __DIR__.'/auth.php';
