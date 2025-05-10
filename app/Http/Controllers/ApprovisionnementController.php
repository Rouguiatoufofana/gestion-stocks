<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
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
    ]);

    $produit = Produit::findOrFail($request->produit_id);
    $produit->quantite_stock += $request->input('quantite');
    $produit->save();
    

    return redirect()->back()->with('success', 'Produit approvisionné avec succès.');
}

}
