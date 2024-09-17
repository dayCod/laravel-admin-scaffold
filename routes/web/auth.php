<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::group(['prefix' => 'login', 'as' => 'login.'], function () {

    Route::get('/', [LoginController::class, 'loginView'])->name('view');
    Route::post('/', [LoginController::class, 'loginAction'])->name('action');

});

Route::group(['prefix' => 'register', 'as' => 'register.'], function () {

    Route::get('/', [RegisterController::class, 'registerView'])->name('view');
    Route::post('/', [RegisterController::class, 'registerAction'])->name('action');

});
