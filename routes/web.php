<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VenteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/approvisionnement', [ApprovisionnementController::class, 'store'])->name('approvisionnement.store');
    // autres routes protégées
});


Route::get('/', [DashboardController::class, 'index'])->name('administration.dashboard');
Route::get('/approvisionnement', [ApprovisionnementController::class, 'index'])->name('approvisionnement.index');
Route::put('/approvisionnement/{id}', [ApprovisionnementController::class, 'update'])->name('approvisionnement.update');
Route::post('/approvisionnement', [ApprovisionnementController::class, 'store'])->name('approvisionnement.store');
// Liste des produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');

// Formulaire d’ajout
Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');

// Enregistrement d’un produit
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');

// Formulaire d’édition
Route::get('/produits/{produit}/edit', [ProduitController::class, 'edit'])->name('produits.edit');

// Mise à jour d’un produit
Route::put('/produits/{produit}', [ProduitController::class, 'update'])->name('produits.update');

// Suppression d’un produit
Route::delete('/produits/{produit}', [ProduitController::class, 'destroy'])->name('produits.destroy');
Route::get('/produits/search', [ProduitController::class, 'search'])->name('produits.search');

Route::get('/ventes', [VenteController::class, 'index'])->name('ventes.index'); // Liste des ventes
Route::get('/ventes/create', [VenteController::class, 'create'])->name('ventes.create'); // Formulaire d'ajout
Route::post('/ventes', [VenteController::class, 'store'])->name('ventes.store'); // Enregistrement d'une vente
Route::post('/ventes/{vente}/delete', [VenteController::class, 'destroy'])->name('ventes.destroy'); // Suppression d'une vente (facultatif)




