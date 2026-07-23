<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEBSITE (PUBLIC)
|--------------------------------------------------------------------------
*/

// Homepage Portal Berita
Route::get('/', [ArticleController::class, 'website'])
    ->name('website');

// Detail Berita
Route::get('/berita/{id}', [ArticleController::class, 'show'])
    ->name('berita.show');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // =========================
    // DASHBOARD
    // =========================

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // =========================
    // ARTICLES
    // =========================

    // Tulis Berita
    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('articles');

    // Simpan Berita
    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store');

    // Daftar Berita
    Route::get('/articles/list', [ArticleController::class, 'list'])
        ->name('articles.list');

    // Edit Berita
    Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])
        ->name('articles.edit');

    // Update Berita
    Route::put('/articles/update/{id}', [ArticleController::class, 'update'])
        ->name('articles.update');

    // Hapus Berita
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');

    // =========================
    // CATEGORIES
    // =========================

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

    // =========================
    // USERS
    // =========================

    Route::get('/users', [UserController::class, 'index'])
        ->name('users');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users/edit/{id}', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/update/{id}', [UserController::class, 'update'])
        ->name('users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    // =========================
    // PROFILE
    // =========================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';