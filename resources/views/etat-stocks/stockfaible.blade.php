@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-danger">Produits en stock critique</h2>

    @if($produits->isEmpty())
        <div class="alert alert-info">
            Aucun produit n’est actuellement en stock critique.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Référence</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Seuil</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->nom }}</td>
                        <td>{{ $produit->reference_produit }}</td>
                        <td>{{ $produit->categorie->nom ?? 'N/A' }}</td>
                        <td>{{ number_format($produit->prix, 0, ',', ' ') }} GNF</td>
                        <td>{{ $produit->quantite_stock }}</td>
                        <td>{{ $produit->seuil }}</td>
                        <td>
                            <div class="alert alert-danger p-1 m-0 text-center">
                                Stock critique
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
