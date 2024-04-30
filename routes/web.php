<?php

use App\Http\Controllers\InsuredController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('2fa')->group(function () {
        Route::post('/2fa', function () {
            return redirect(route('insureds.index'));
        })->name('2fa');
        Route::prefix('insureds')->name('insureds.')->group(function () {
            Route::get('/', [InsuredController::class, 'index'])->name('index');
            Route::post('/', [InsuredController::class, 'store'])->name('store');
            Route::get('/create', [InsuredController::class, 'create'])->name('create');
            Route::get('/search', [InsuredController::class, 'search'])->name('search');
        });
    });
});

require __DIR__.'/auth.php';
