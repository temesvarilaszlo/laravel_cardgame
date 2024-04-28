<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use App\Models\Contest;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [CharacterController::class, 'indexGuest']);

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('characters.index');
    } else {
        return app(CharacterController::class)->indexGuest();
    }
});

Route::middleware('auth')->group(function () {
    Route::get('characters/enemies', [CharacterController::class, 'showEnemies'])->name('characters.enemies');
    Route::resource('/characters', CharacterController::class);
    Route::resource('/places', PlaceController::class);
    Route::resource('/contests', ContestController::class);
    // Route::post('/contests', [ContestController::class, 'store'])->name('contests.store');
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
