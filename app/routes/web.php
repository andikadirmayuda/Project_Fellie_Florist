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
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin'])->group(function () {
        Route::resource('kategori', KategoriController::class);
        Route::resource('produk', ProdukController::class);
        Route::resource('variasi', VariasiProdukController::class);
        Route::resource('inventaris', InventarisController::class);
        Route::resource('users', UserController::class);
    });
    
    // Routes for Kasir
    Route::prefix('kasir')->name('kasir.')->middleware(['auth', 'can:kasir'])->group(function () {
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/variasi', [VariasiProdukController::class, 'index'])->name('variasi.index');
        Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
        Route::get('/inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
        Route::post('/inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
    });
    
    // Routes for Karyawan
    Route::prefix('karyawan')->name('karyawan.')->middleware(['auth', 'can:karyawan'])->group(function () {
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/variasi', [VariasiProdukController::class, 'index'])->name('variasi.index');
        Route::get('/inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    });
    
    // Routes for Pelanggan
    Route::prefix('pelanggan')->name('pelanggan.')->middleware(['auth', 'can:pelanggan'])->group(function () {
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/variasi', [VariasiProdukController::class, 'index'])->name('variasi.index');
    });
});

require __DIR__.'/auth.php';
