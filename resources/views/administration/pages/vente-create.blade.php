@extends('administration.base')

@section('content')
<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Nouvelle vente</h3>
        <a href="{{ route('ventes.index') }}" class="btn btn-secondary">← Retour</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ventes.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="produit_id" class="form-label">Produit</label>
                    <select name="produit_id" id="produit_id" class="form-select" required>
                        <option value="">-- Sélectionner un produit --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" {{ old('produit_id') == $produit->id ? 'selected' : '' }}>
                                {{ $produit->nom }} (Stock: {{ $produit->quantite_stock }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité</label>
                    <input type="number" name="quantite" id="quantite" class="form-control" value="{{ old('quantite') }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="prix_vente" class="form-label">Prix de vente (GNF)</label>
                    <input type="number" name="prix_vente" id="prix_vente" class="form-control" value="{{ old('prix_vente') }}" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="date_vente" class="form-label">Date de vente</label>
                    <input type="datetime-local" name="date_vente" id="date_vente" class="form-control" value="{{ old('date_vente') ?? now()->format('Y-m-d\TH:i') }}" required>
                </div>

                <button type="submit" class="btn btn-success">Enregistrer la vente</button>
            </div>
        </div>
    </form>
</div>
@endsection
