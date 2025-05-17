@extends('admin.base')
@section('content')
<div class="container">
    <h2>Modifier un produit</h2>
    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" value="{{ $produit->nom }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $produit->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control">
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $categorie->id == $produit->categorie_id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Prix de vente</label>
            <input type="number" name="prix_vente" value="{{ $produit->prix_vente }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stock actuel</label>
            <input type="number" name="stock_actuel" value="{{ $produit->stock_actuel }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Seuil d'alerte</label>
            <input type="number" name="seuil_alerte" value="{{ $produit->seuil_alerte }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
@endsection