@extends('admin.base')
@section('content')
<div class="container">
    <h2>Nouvel approvisionnement</h2>
    <form action="{{ route('approvisionnements.store') }}" method="POST">
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
            <label>Quantité</label>
            <input type="number" name="quantite" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date_approvisionnement" class="form-control" value="{{ date('Y-m-d') }}">
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection