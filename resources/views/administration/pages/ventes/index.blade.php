@extends('admin.base')
@section('content')
<div class="container">
    <h1>Historique des ventes</h1>
    <a href="{{ route('ventes.create') }}" class="btn btn-primary mb-3">Nouvelle vente</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Produit</th><th>Quantité</th><th>Total</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach ($ventes as $vente)
<tr>
    <td>{{ $vente->produit->nom }}</td>
    <td>{{ $vente->quantite }}</td>
    <td>{{ $vente->produit->prix_vente }} Fcfa</td>
    <td>{{ $vente->date_vente }}</td>
    <td>
        <a href="{{ route('ventes.edit', $vente->id) }}" class="btn btn-warning btn-sm">Modifier</a>
        <form action="{{ route('ventes.destroy', $vente->id) }}" method="POST" style="display:inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
        </form>
        <a href="{{ url('/recu/vente/' . $vente->id) }}" target="_blank" class="btn btn-info btn-sm">PDF</a>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>
@endsection