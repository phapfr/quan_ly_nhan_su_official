<?php

use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\LuongController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhongBanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NhanVienController::class, 'thongKe']);


Route::prefix('admin')->group(function () {
    Route::prefix('nhan-vien')->group(function () {
        Route::get('/index', [NhanVienController::class, 'index']);
        Route::post('/store', [NhanVienController::class, 'store']);
        Route::get('/data', [NhanVienController::class, 'getData']);
        Route::get('/thong-ke', [NhanVienController::class, 'thongKe']);
    });

    Route::prefix('chuc-vu')->group(function () {
        Route::get('/index', [ChucVuController::class, 'index']);
        Route::post('/store', [ChucVuController::class, 'store']);
        Route::get('/data', [ChucVuController::class, 'getData']);
    });

    Route::prefix('phong-ban')->group(function () {
        Route::get('/index', [PhongBanController::class, 'index']);
        Route::post('/store', [PhongBanController::class, 'store']);
        Route::get('/data', [PhongBanController::class, 'getData']);
    });

    Route::prefix('luong')->group(function () {
        Route::get('/index', [LuongController::class, 'index']);
        Route::post('/store', [LuongController::class, 'store']);
        Route::get('/data', [LuongController::class, 'getData']);
    });
});
