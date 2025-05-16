<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class EtatStockController extends Controller
{
    public function index(Request $request)
    {
        $filtre = $request->input('filtre');

        // Vérifie si l'utilisateur veut filtrer les produits critiques
        if ($filtre === 'critiques') {
            $produits = Produit::with('categorie')
                ->where('quantite_stock', '<', 5)
                ->paginate(10);
        } else {
            // Sinon, on affiche tous les produits
            $produits = Produit::with('categorie')->paginate(10);
        }

        // Récupère tous les produits en rupture (stock critique) pour la liste rapide
        $produitsRupture = Produit::where('quantite_stock', '<', 5)->get();

        // Retourne la vue avec les produits à afficher et le filtre sélectionné
        return view('etat-stocks.index', compact('produits', 'produitsRupture', 'filtre'));
    }
}
