@extends('layouts.app')

@section('content')
    <h1 style="margin-bottom: 20px;">Gestion des Produits</h1>
    

    <a href="{{ route('produits.create') }}" style="
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #28a745;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    ">Ajouter un produit</a>

    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
        <thead style="background-color: #f0f0f0;">
            <tr>
                <th style="border: 1px solid #ccc; padding: 10px;">Nom</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Référence</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Design</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Catégorie</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Prix</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Quantité</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Seuil</th>
                <th style="border: 1px solid #ccc; padding: 10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $produit)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $produit->nom }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $produit->reference_produit }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $produit->design_produit }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $produit->categorie->nom ?? 'Aucune' }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $produit->prix }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $produit->quantite_stock }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">{{ $produit->seuil }}</td>
                    <td style="border: 1px solid #ccc; padding: 10px;">
                        <a href="{{ route('produits.edit', $produit->id) }}" style="margin-right: 10px; color: blue;">Modifier</a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Confirmer la suppression ?')" style="color: red; background: none; border: none; cursor: pointer;">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
