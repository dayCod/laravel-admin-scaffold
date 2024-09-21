<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Utilities\RolePermissionController;
use App\Http\Controllers\Admin\Utilities\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
Route::post('/profile', [DashboardController::class, 'submitProfile'])->name('profile.submit');

Route::group(['prefix' => 'utilities', 'as' => 'utilities.'], function () {

    Route::group(['prefix' => 'rolepermission', 'as' => 'rolepermission.'], function () {
        Route::get('/', [RolePermissionController::class, 'index'])->name('index');
        Route::get('/create', [RolePermissionController::class, 'create'])->name('create');
        Route::post('/store', [RolePermissionController::class, 'store'])->name('store');
        Route::get('/{id}/show', [RolePermissionController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [RolePermissionController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [RolePermissionController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [RolePermissionController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'userrole', 'as' => 'userrole.'], function () {
        Route::get('/', [UserRoleController::class, 'index'])->name('index');
        Route::get('/create', [UserRoleController::class, 'create'])->name('create');
        Route::post('/store', [UserRoleController::class, 'store'])->name('store');
        Route::get('/{id}/show', [UserRoleController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [UserRoleController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [UserRoleController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [UserRoleController::class, 'delete'])->name('delete');
    });

});
