@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 20px;">Ajouter un Produit</h1>

    {{-- Message d'erreur si aucune catégorie --}}
    @if ($categories->isEmpty())
        <div style="padding: 10px; background-color: #f8d7da; color: #721c24; margin-bottom: 20px;">
        </div>
    @endif

    <form action="{{ route('produits.store') }}" method="POST" style="max-width: 600px;">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="nom" style="display:block; margin-bottom:5px;">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="reference_produit" style="display:block; margin-bottom:5px;">Référence</label>
            <input type="text" name="reference_produit" id="reference_produit" placeholder="" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="design_produit" style="display:block; margin-bottom:5px;">Design</label>
            <input type="text" name="design_produit" id="design_produit" placeholder="" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="categorie_id" style="display:block; margin-bottom:5px;">Catégorie</label>
            <select name="categorie_id" id="categorie_id" required style="width: 100%; padding: 8px;" {{ $categories->isEmpty() ? 'disabled' : '' }}>
                @if (!$categories->isEmpty())
                    <option value="">Vertements</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                @else
                    <option value="">Aucune catégorie disponible</option>
                @endif
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="prix" style="display:block; margin-bottom:5px;">Prix</label>
            <input type="number" name="prix" id="prix" placeholder="" step="0.01" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="quantite_stock" style="display:block; margin-bottom:5px;">Quantité en stock</label>
            <input type="number" name="quantite_stock" id="quantite_stock" value="" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="seuil" style="display:block; margin-bottom:5px;">Seuil d’alerte</label>
            <input type="number" name="seuil" id="seuil" value="5" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" 
            {{ $categories->isEmpty() ? 'disabled' : '' }}
            style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Ajouter
        </button>
    </form>
@endsection
