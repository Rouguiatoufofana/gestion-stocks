<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Approvisionnement;
use Illuminate\Support\Carbon;


class ApprovisionnementController extends Controller
{
    public function index()
    {
        // Pagination avec relation 'categorie'
        $produits = Produit::with('categorie')->paginate(3);
    
        // Produits en rupture (stock < 10)
        $produitsRupture = Produit::where('quantite_stock', '<', 10)->get();
    
        return view('administration.pages.approvisionnement', [
            'produits' => $produits,
            'produitsRupture' => $produitsRupture
        ]);
    }
    
    
public function update(Request $request, $id)
{
    $request->validate([
        'quantite' => 'required|integer|min:1'
    ]);

    $produit = Produit::findOrFail($id);
    $produit->quantite += $request->quantite;
    $produit->save();

    return redirect()->route('approvisionnement.index')->with('success', 'Produit approvisionné avec succès.');
}

public function store(Request $request)
{
    $request->validate([
        'produit_id' => 'required|exists:produits,id',
        'quantite' => 'required|integer|min:1',
        'nom_fournisseur' => 'required|string|max:255',
        'prix_achat' => 'required|numeric|min:0',
        'date_approvisionnement' => 'nullable|date',
    ]);

    Approvisionnement::create([
        'produit_id' => $request->produit_id,
        'quantite' => $request->quantite,
        'nom_fournisseur' => $request->nom_fournisseur,
        'prix_achat' => $request->prix_achat,
        'date_approvisionnement' => $request->date_approvisionnement ?? Carbon::now(),
        
    ]);

    // Met à jour le stock du produit
    $produit = Produit::find($request->produit_id);
    $produit->quantite_stock += $request->quantite;
    $produit->save();

    return redirect()->back()->with('success', 'Produit approvisionné avec succès.');
}


}
