@extends('admin.base')
@section('content')
<div class="container">
    <h2>Liste des produits</h2>
    <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Seuil d'alerte</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr class="{{ $produit->stock_actuel <= $produit->seuil_alerte ? 'table-danger' : '' }}">
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->categorie->nom ?? '' }}</td>
                    <td>{{ $produit->prix_vente }} Fcfa</td>
                    <td>{{ $produit->stock_actuel }}</td>
                    <td>{{ $produit->seuil_alerte }}</td>
                    <td>
                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection