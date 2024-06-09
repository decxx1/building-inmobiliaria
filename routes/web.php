<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'loginRegister' => '',
    ]);
})->name('welcome');

Route::get('register', function () {
    return Inertia::render('Welcome', [
        'loginRegister' => 'sign-up-mode',
    ]);
})->name('register');

Route::prefix('/app')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/products',[UserController::class, 'index'])->name('products');
        Route::get('/providers',[ProviderController::class, 'index'])->name('providers');
        Route::post('/providers',[ProviderController::class, 'store'])->name('providers.store');

        Route::get('/users',[UserController::class, 'index'])->name('users');
        Route::post('/users',[UserController::class, 'store'])->name('users.store');
        Route::put('/users/{id}',[UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}',[UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/users/password/{id}',[UserController::class, 'updatePassword'])->name('users.update.password');
        Route::post('/users/avatar/{id}',[UserController::class, 'updateAvatar'])->name('users.avatar');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
