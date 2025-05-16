<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ApprovisionnementController;
use App\Http\Controllers\EtatStockController;

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

Route::get('/', [DashboardController::class, 'index'])->name('administration.dashboard');
Route::get('/approvisionnement', [ApprovisionnementController::class, 'index'])->name('approvisionnement.index');
Route::put('/approvisionnement/{id}', [ApprovisionnementController::class, 'update'])->name('approvisionnement.update');
Route::post('/approvisionnement', [ApprovisionnementController::class, 'store'])->name('approvisionnement.store');


// Routes pour la gestion des stocks
Route::get('/etat-stocks', [EtatStockController::class, 'index'])->name('etat.stocks');



