@extends('administration.base')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Ajouter un produit</h3>
            <a href="{{ route('produits.index') }}" class="btn btn-secondary">← Retour</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('produits.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nom">Nom du produit</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="reference_produit">Référence</label>
                    <input type="text" name="reference_produit" id="reference_produit" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="design_produit">Description</label>
                    <textarea name="design_produit" id="design_produit" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="categorie_id">Catégorie</label>
                    <select name="categorie_id" id="categorie_id" class="form-control" required>
                        <option value="">Vetenment</option>
                         <option value="">Vetenment2</option>
                          <option value="">Vetenment3</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="prix">Prix (en GNF)</label>
                    <input type="number" name="prix" id="prix" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="quantite_stock">Quantité en stock</label>
                    <input type="number" name="quantite_stock" id="quantite_stock" class="form-control" required>
                </div>

                <div class="form-group mb-4">
                    <label for="seuil">Seuil de réapprovisionnement</label>
                    <input type="number" name="seuil" id="seuil" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</div>
@endsection
