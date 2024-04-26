<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [CharacterController::class, 'indexGuest']);

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('characters.index'); // Redirect authenticated users to dashboard
    } else {
        return app(CharacterController::class)->indexGuest(); // Call indexGuest method for guest users
    }
});

Route::middleware('auth')->group(function () {
    Route::get('characters/enemies', [CharacterController::class, 'showEnemies'])->name('characters.enemies');
    Route::resource('/characters', CharacterController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
