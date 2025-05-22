<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/* Routes pour mot de passe oublié */
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

/* Page de login */
Route::get('/', function () {
    return view('auth.login');
});

/* Déconnexion */
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');

/* Profil : accessible à tous les utilisateurs connectés */
Route::get('/mon-profile', function () {
    return view('administration.pages.profile');
})->middleware(['auth'])->name('mon.profile');

/* Dashboard */
Route::get('/dashboard', function () {
    return view('administration.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* Routes accessibles à tous les utilisateurs connectés */
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('administration.pages.dashboard');
    Route::get('/approvisionnement', [ApprovisionnementController::class, 'index'])->name('approvisionnement.index');
    Route::put('/approvisionnement/{id}', [ApprovisionnementController::class, 'update'])->name('approvisionnement.update');
    Route::post('/approvisionnement', [ApprovisionnementController::class, 'store'])->name('approvisionnement.store');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

/* ✅ Routes de profil protégées : uniquement pour les admins */
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'update']); // doublon utile si tu utilises PUT
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// route pour l'admin



    use App\Http\Controllers\Admin\UserManagementController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';
