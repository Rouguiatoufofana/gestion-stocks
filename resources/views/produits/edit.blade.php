@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 20px;">Modifier le Produit</h1>

    <form action="{{ route('produits.update', $produit->id) }}" method="POST" style="max-width: 600px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="nom" style="display:block; margin-bottom:5px;">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ $produit->nom }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="reference_produit" style="display:block; margin-bottom:5px;">Référence</label>
            <input type="text" name="reference_produit" id="reference_produit" value="{{ $produit->reference_produit }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="design_produit" style="display:block; margin-bottom:5px;">Design</label>
            <input type="text" name="design_produit" id="design_produit" value="{{ $produit->design_produit }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="categorie_id" style="display:block; margin-bottom:5px;">Catégorie</label>
            <select name="categorie_id" id="categorie_id" required style="width: 100%; padding: 8px;">
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="prix" style="display:block; margin-bottom:5px;">Prix</label>
            <input type="number" name="prix" id="prix" value="{{ $produit->prix }}" required style="width: 100%; padding: 8px;" step="0.01">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="quantite_stock" style="display:block; margin-bottom:5px;">Quantité en stock</label>
            <input type="number" name="quantite_stock" id="quantite_stock" value="{{ $produit->quantite_stock }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="seuil" style="display:block; margin-bottom:5px;">Seuil</label>
            <input type="number" name="seuil" id="seuil" value="{{ $produit->seuil }}" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px;">
            Mettre à jour
        </button>
    </form>
@endsection
