<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use Illuminate\Http\Request;
use App\Models\Produit;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $ventes = Vente::with('produit')->latest()->paginate(10);
        return view('administration.pages.vente-list', compact('ventes'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $produits = Produit::all();
    return view('administration.pages.vente-create', compact('produits'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);

        $produit = Produit::findOrFail($request->produit_id);

        // Vérifie le stock
        if ($request->quantite > $produit->quantite_stock) {
            return back()->withErrors(['quantite' => 'Quantité demandée supérieure au stock disponible.']);
        }

        // Enregistre la vente
        $vente = Vente::create([
            'produit_id' => $produit->id,
            'quantite' => $request->quantite,
            'prix_vente' => $produit->prix * $request->quantite,
        ]);

        // Met à jour le stock du produit
        $produit->decrement('quantite_stock', $request->quantite);

        return redirect()->route('ventes.index')->with('success', 'Vente enregistrée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vente $vente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vente $vente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vente $vente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vente $vente)
    {
        $vente->delete();
        return back()->with('success', 'Vente supprimée.');
    }
}
