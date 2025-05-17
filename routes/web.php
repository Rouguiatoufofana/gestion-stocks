<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminDashboardController,
    AdminEmployeController,
    ApprovisionnementController,
    CategorieController,
    DashboardController,
    EmployeDashboardController,
    PdfController,
    ProduitController,
    ProfileController,
    UserController,
    VenteController
};

// Redirection vers login par défaut
Route::get('/', fn () => redirect()->route('login'));

// Redirection post-authentification selon le rôle
Route::get('/redirect', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('employe.dashboard');
})->middleware('auth')->name('redirect');


// ========== AUTHENTIFICATION ========== //
require __DIR__ . '/auth.php';


// ========== ADMIN ========= //
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

   
    // Activation/désactivation utilisateur
    Route::post('/users/{user}/toggle-activation', [UserController::class, 'toggleActivation'])->name('users.toggle-activation');
});


// ========== EMPLOYÉ ========= //
Route::middleware(['auth', 'employe'])->prefix('employe')->name('employe.')->group(function () {
    Route::get('/dashboard', [EmployeDashboardController::class, 'index'])->name('dashboard');
});


// ========== PROFIL UTILISATEUR ========= //
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ========== GESTION DES RESSOURCES ========= //
Route::middleware(['auth'])->group(function () {
    Route::resource('produits', ProduitController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('approvisionnements', ApprovisionnementController::class);
    Route::resource('ventes', VenteController::class);
     // Gestion des employés
    Route::get('/employes', [AdminEmployeController::class, 'index'])->name('employes.index');
    Route::get('/employes/create', [AdminEmployeController::class, 'create'])->name('employes.create');
    Route::post('/employes', [AdminEmployeController::class, 'store'])->name('employes.store');
    Route::delete('/employes/{employe}', [AdminEmployeController::class, 'destroy'])->name('employes.destroy');
    Route::post('/employes/{user}/toggle', [AdminEmployeController::class, 'toggleStatus'])->name('employes.toggle');

});


// ========== PDF REÇUS ========= //
Route::get('/recu/vente/{id}', [PdfController::class, 'venteRecu']);
Route::get('/recu/approvisionnement/{id}', [PdfController::class, 'approvisionnementRecu']);


// ========== HOME (si utile) ========= //
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
