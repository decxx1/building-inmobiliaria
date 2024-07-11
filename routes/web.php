<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ImageController;
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


Route::get('/',[PropertyController::class, 'indexWeb'])->name('index');
Route::get('/inmuebles',[PropertyController::class, 'inmueblesWeb'])->name('inmuebles');
Route::get('/inmueble/{id}',[PropertyController::class, 'inmueblesWebShow'])->name('inmuebles.show');
//formularios de contacto
Route::post('/consult',[ConsultationController::class, 'property'])->name('consult.property');
Route::post('/consult',[ConsultationController::class, 'footer'])->name('consult.footer');
Route::post('/consult',[ConsultationController::class, 'contact'])->name('consult.contact');

Route::get('/contacto', function () {
    return Inertia::render('Contact');
})->name('contacto');


Route::get('/admin', function () {
    return Inertia::render('Admin');
})->name('admin');


Route::prefix('/app')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/products',[UserController::class, 'index'])->name('products');
        Route::get('/properties',[PropertyController::class, 'index'])->name('properties');
        Route::post('/properties',[PropertyController::class, 'store'])->name('properties.store');
        Route::post('/properties/{id}',[PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{id}',[PropertyController::class, 'destroy'])->name('properties.destroy');

        Route::get('/images/{id}/{position}',[ImageController::class, 'destroy'])->name('images.destroy');

        Route::get('/cities/{id}',[CityController::class, 'index'])->name('cities');
        Route::get('/zones/{id}',[ZoneController::class, 'index'])->name('zones');

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
