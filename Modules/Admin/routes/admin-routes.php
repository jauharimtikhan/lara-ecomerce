<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modules\Admin\Controllers\CategoryController;
use App\Http\Controllers\Modules\Admin\Controllers\UserController;
use App\Http\Controllers\Modules\Admin\Controllers\HomeController;
use App\Http\Controllers\Modules\Admin\Controllers\ProductController;
use App\Http\Controllers\Modules\Admin\Controllers\SubCategoryController;
use App\Http\Controllers\Modules\Admin\Controllers\OrdersController;
use App\Http\Controllers\Modules\Admin\Controllers\ReportController;
use App\Http\Controllers\Modules\Admin\Controllers\TampilanController;
use App\Http\Controllers\Modules\Admin\Controllers\HakAksesController;

Route::middleware(['auth', 'role:admin|super_admin'])->prefix('admin')->group(function () {
    Route::resource('dashboard', HomeController::class)->names('admin.dashboard');
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('admin.user.index');
        Route::get('/create', 'create')->name('admin.user.create');
        Route::get('/{user}', 'show')->name('admin.user.show');
        Route::get('/data/all', 'getAllData')->name('admin.user.all');
        Route::post('/', 'store')->name('admin.user.store');
        Route::post('/{user}/update', 'update')->name('admin.user.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.user.bulkdelete');
        Route::delete('/{user}', 'destroy')->name('admin.user.destroy');
    });
    Route::controller(CategoryController::class)->prefix('kategori')->group(function () {
        Route::get('/', 'index')->name('admin.kategori.index');
        Route::get('/create', 'create')->name('admin.kategori.create');
        Route::get('/{kategori}', 'show')->name('admin.kategori.show');
        Route::get('/{kategori}/edit', 'edit')->name('admin.kategori.edit');
        Route::get('/data/all', 'getAllData')->name('admin.kategori.data');
        Route::post('/', 'store')->name('admin.kategori.store');
        Route::post('/{kategori}/update', 'update')->name('admin.kategori.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.kategori.bulkdelete');
        Route::delete('/{kategori}', 'destroy')->name('admin.kategori.destroy');
    });
    Route::controller(SubCategoryController::class)->prefix('sub_kategori')->group(function () {
        Route::get('/', 'index')->name('admin.subkategori.index');
        Route::get('/create', 'create')->name('admin.subkategori.create');
        Route::get('/{subkategori}', 'show')->name('admin.subkategori.show');
        Route::get('/{subkategori}/edit', 'edit')->name('admin.subkategori.edit');
        Route::get('/data/all', 'getAllData')->name('admin.subkategori.data');
        Route::post('/', 'store')->name('admin.subkategori.store');
        Route::post('/{subkategori}/update', 'update')->name('admin.subkategori.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.subkategori.bulkdelete');
        Route::delete('/{subkategori}', 'destroy')->name('admin.subkategori.destroy');
    });
    Route::controller(ProductController::class)->prefix('produk')->group(function () {
        Route::get('/', 'index')->name('admin.produk.index');
        Route::get('/create', 'create')->name('admin.produk.create');
        Route::get('/{produk}', 'show')->name('admin.produk.show');
        Route::get('/{produk}/edit', 'edit')->name('admin.produk.edit');
        Route::get('/data/all', 'getAllData')->name('admin.produk.data');
        Route::post('/', 'store')->name('admin.produk.store');
        Route::post('/{produk}/update', 'update')->name('admin.produk.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.produk.bulkDelete');
        Route::post('/bulForcekDeleteAction', 'bulkForceDelete')->name('admin.produk.bulkPermanentDelete');
        Route::post('/search/form', 'search')->name('admin.produk.search');
        Route::post('/restore/data', 'restoreData')->name('admin.produk.restore');
        Route::delete('/{produk}', 'destroy')->name('admin.produk.destroy');
    });
    Route::controller(OrdersController::class)->prefix('pesanan')->group(function () {
        Route::get('/', 'index')->name('admin.pesanan.index');
        Route::get('/create', 'create')->name('admin.pesanan.create');
        Route::get('/{pesanan}', 'show')->name('admin.pesanan.show');
        Route::get('/{pesanan}/edit', 'edit')->name('admin.pesanan.edit');
        Route::get('/data/all/{pesanan}', 'getAllData')->name('admin.pesanan.data');
        Route::post('/', 'store')->name('admin.pesanan.store');
        Route::post('/{pesanan}/update', 'update')->name('admin.pesanan.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.pesanan.bulkdelete');
        Route::delete('/{pesanan}', 'destroy')->name('admin.pesanan.destroy');
    });
    Route::controller(ReportController::class)->prefix('laporan')->group(function () {
        Route::get('/', 'index')->name('admin.laporan.index');
        Route::get('/create', 'create')->name('admin.laporan.create');
        Route::get('/{laporan}', 'show')->name('admin.laporan.show');
        Route::get('/{laporan}/edit', 'edit')->name('admin.laporan.edit');
        Route::get('/data/all', 'getAllData')->name('admin.laporan.data');
        Route::post('/', 'store')->name('admin.laporan.store');
        Route::post('/{laporan}/update', 'update')->name('admin.laporan.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.laporan.bulkdelete');
        Route::delete('/{laporan}', 'destroy')->name('admin.laporan.destroy');
    });
    Route::controller(TampilanController::class)->prefix('tampilan')->group(function () {
        Route::get('/', 'index')->name('admin.tampilan.index');
        Route::get('/create', 'create')->name('admin.tampilan.create');
        Route::get('/{tampilan}', 'show')->name('admin.tampilan.show');
        Route::get('/{tampilan}/edit', 'edit')->name('admin.tampilan.edit');
        Route::get('/data/all', 'getAllData')->name('admin.tampilan.data');
        Route::post('/', 'store')->name('admin.tampilan.store');
        Route::post('/{tampilan}/update', 'update')->name('admin.tampilan.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.tampilan.bulkdelete');
        Route::delete('/{tampilan}', 'destroy')->name('admin.tampilan.destroy');
    });
    Route::controller(HakAksesController::class)->prefix('hak_akses')->group(function () {
        Route::get('/', 'index')->name('admin.hakakses.index');
        Route::get('/create', 'create')->name('admin.hakakses.create');
        Route::get('/{hakakses}', 'show')->name('admin.hakakses.show');
        Route::get('/{hakakses}/edit', 'edit')->name('admin.hakakses.edit');
        Route::get('/data/all', 'getAllData')->name('admin.hakakses.data');
        Route::post('/', 'store')->name('admin.hakakses.store');
        Route::post('/{hakakses}/update', 'update')->name('admin.hakakses.update');
        Route::post('/bulkDeleteAction', 'bulkDelete')->name('admin.hakakses.bulkdelete');
        Route::delete('/{hakakses}', 'destroy')->name('admin.hakakses.destroy');
    });
});
