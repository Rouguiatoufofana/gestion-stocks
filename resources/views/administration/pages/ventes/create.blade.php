@extends('admin.base')
@section('content')
<div class="container">
    <h2>Nouvelle vente</h2>
    <form action="{{ route('ventes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Produit</label>
            <select name="produit_id" class="form-control">
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Quantité vendue</label>
            <input type="number" name="quantite" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date_vente" class="form-control" value="{{ date('Y-m-d') }}">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection