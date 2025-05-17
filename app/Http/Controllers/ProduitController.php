<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits.index', compact('produits'));
        
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'reference_produit' => 'required|unique:produits',
            'design_produit' => 'required',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|numeric',
            'quantite_stock' => 'required|integer',
            'seuil' => 'required|integer',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès!');
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $request->validate([
            'nom' => 'required',
            'reference_produit' => 'required|unique:produits,reference_produit,' . $produit->id,
            'design_produit' => 'required',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|numeric',
            'quantite_stock' => 'required|integer',
            'seuil' => 'required|integer',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès!');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès!');
    }
}
