<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $search = $request->input('search');

    $produits = Produit::with('categorie')
        ->when($search, function ($query, $search) {
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhereHas('categorie', function ($q) use ($search) {
                      $q->where('nom', 'like', "%{$search}%");
                  });
        })
        ->paginate(3);

    return view('administration.pages.index', compact('produits', 'search'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('administration.pages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'reference_produit' => 'nullable|string|max:255',
            'design_produit' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|integer|min:0',
            'seuil' => 'required|integer|min:0',
        ]);

        Produit::create($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        return view('administration.pages.edit', compact('produit', 'categories'));
    }

    public function search(Request $request)
{
    $search = $request->input('search');

    $produits = Produit::with('categorie')
        ->where(function ($query) use ($search) {
            $query->where('nom', 'like', "%{$search}%")
                ->orWhereHas('categorie', function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%");
                });
        })
        ->get();

    return response()->json(['produits' => $produits]);
}



    /**
     * Update the specified resource in storage.
     */
      public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'reference_produit' => 'nullable|string|max:255',
            'design_produit' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|integer|min:0',
            'seuil' => 'required|integer|min:0',
        ]);

        $produit->update($request->all());

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
