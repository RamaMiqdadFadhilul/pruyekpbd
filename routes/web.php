<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MarginPenjualanController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PengadaanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/barang', [BarangController::class, 'index'])
    ->name('barang.index');

Route::get('/barang/create', [BarangController::class, 'create'])
    ->name('barang.create');

Route::post('/barang', [BarangController::class, 'store'])
    ->name('barang.store');

Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])
    ->name('barang.edit');

Route::put('/barang/{id}', [BarangController::class, 'update'])
    ->name('barang.update');

Route::delete('/barang/{id}', [BarangController::class, 'destroy'])
    ->name('barang.destroy');

Route::get('/satuan', [SatuanController::class, 'index'])
    ->name('satuan.index');

Route::get('/satuan/create', [SatuanController::class, 'create'])
    ->name('satuan.create');

Route::post('/satuan', [SatuanController::class, 'store'])
    ->name('satuan.store');

Route::get('/satuan/{id}/edit', [SatuanController::class, 'edit'])
    ->name('satuan.edit');

Route::put('/satuan/{id}', [SatuanController::class, 'update'])
    ->name('satuan.update');

Route::delete('/satuan/{id}', [SatuanController::class, 'destroy'])
    ->name('satuan.destroy');

// Master Vendor
Route::get('/vendor', [VendorController::class, 'index'])
    ->name('vendor.index');

Route::get('/vendor/create', [VendorController::class, 'create'])
    ->name('vendor.create');

Route::post('/vendor', [VendorController::class, 'store'])
    ->name('vendor.store');

Route::get('/vendor/{id}/edit', [VendorController::class, 'edit'])
    ->name('vendor.edit');

Route::put('/vendor/{id}', [VendorController::class, 'update'])
    ->name('vendor.update');

Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])
    ->name('vendor.destroy');

// Master User
Route::get('/user', [UserController::class, 'index'])
    ->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])
    ->name('user.create');

Route::post('/user', [UserController::class, 'store'])
    ->name('user.store');

Route::get('/user/{id}/edit', [UserController::class, 'edit'])
    ->name('user.edit');
    
Route::put('/user/{id}', [UserController::class, 'update'])
    ->name('user.update');

// Master Role
Route::get('/role', [RoleController::class, 'index'])
    ->name('role.index');

Route::get('/role/create', [RoleController::class, 'create'])
    ->name('role.create');

Route::post('/role', [RoleController::class, 'store'])
    ->name('role.store');

Route::get('/role/{id}/edit', [RoleController::class, 'edit'])
    ->name('role.edit');

Route::put('/role/{id}', [RoleController::class, 'update'])
    ->name('role.update');

// Master Margin Penjualan
Route::get('/margin-penjualan', [MarginPenjualanController::class, 'index'])
    ->name('margin-penjualan.index');

Route::get('/margin-penjualan/create', [MarginPenjualanController::class, 'create'])
    ->name('margin-penjualan.create');

Route::post('/margin-penjualan', [MarginPenjualanController::class, 'store'])
    ->name('margin-penjualan.store');

Route::get('/margin-penjualan/{id}/edit', [MarginPenjualanController::class, 'edit'])
    ->name('margin-penjualan.edit');

Route::put('/margin-penjualan/{id}', [MarginPenjualanController::class, 'update'])
    ->name('margin-penjualan.update');

Route::patch('/margin-penjualan/{id}/status', [MarginPenjualanController::class, 'toggleStatus'])
    ->name('margin-penjualan.toggle-status');

// Inventaris
Route::get('/inventaris', [InventarisController::class, 'index'])
    ->name('inventaris.index');

Route::get('/inventaris/{id}/riwayat', [InventarisController::class, 'riwayat'])
    ->name('inventaris.riwayat');

// Pengadaan
Route::get('/pengadaan', [PengadaanController::class, 'index'])
    ->name('pengadaan.index');

Route::get('/pengadaan/create', [PengadaanController::class, 'create'])
    ->name('pengadaan.create');

Route::post('/pengadaan', [PengadaanController::class, 'store'])
    ->name('pengadaan.store');

Route::get('/pengadaan/{id}', [PengadaanController::class, 'show'])
    ->name('pengadaan.show');

Route::post('/pengadaan/{id}/detail', [PengadaanController::class, 'tambahDetail'])
    ->name('pengadaan.detail.store');