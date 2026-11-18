<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalistController;
use App\Http\Controllers\TextController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/texts/{text}', [TextController::class, 'show'])->name('texts.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::middleware('role:journalist,admin')->prefix('journalist')->name('journalist.')->group(function () {
        Route::get('/', [JournalistController::class, 'index'])->name('index');
        Route::get('/create', [JournalistController::class, 'create'])->name('create');
        Route::post('/', [JournalistController::class, 'store'])->name('store');
        Route::get('/{text}/edit', [JournalistController::class, 'edit'])->name('edit');
        Route::put('/{text}', [JournalistController::class, 'update'])->name('update');
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/texts/{text}/edit', [AdminController::class, 'edit'])->name('texts.edit');
        Route::put('/texts/{text}', [AdminController::class, 'update'])->name('texts.update');
        Route::patch('/texts/{text}/block', [AdminController::class, 'block'])->name('texts.block');
        Route::delete('/texts/{text}', [AdminController::class, 'destroy'])->name('texts.destroy');
        Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.role');
    });
});
