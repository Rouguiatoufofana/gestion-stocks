@extends('admin.base')
@section('content')
<div class="container">
    <h2>Ajouter un produit</h2>
    <form action="{{ route('produits.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control">
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Prix de vente</label>
            <input type="number" name="prix_vente" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stock actuel</label>
            <input type="number" name="stock_actuel" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Seuil d'alerte</label>
            <input type="number" name="seuil_alerte" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
