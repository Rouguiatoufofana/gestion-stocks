@extends('administration.base')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Approvisionnement</h3>
        </div>
    </div>

    <main class="container-fluid px-5">
    @if(session('success'))
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
@endif

        <div class="card-body">
            @if($produitsRupture->isEmpty())
            
            @endif
        </div>
    </div>

    {{-- Tableau des produits --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Liste des produits</div>
        </div>
        <div class="card-body">
            @if($produits->isEmpty())
                <p class="text-muted">Aucun produit disponible.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produits as $produit)
                        <tr>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->categorie->nom ?? 'Non défini' }}</td>
                            <td>{{ $produit->quantite_stock }}</td>
                            <td>{{ $produit->prix }} GNF</td>
                            <td>
                                <!-- Bouton qui ouvre la modale -->
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approvisionnerModal{{ $produit->id }}">
                                    Approvisionner
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
    {{ $produits->links() }}
        </div>
            @endif
        </div>
    </div>
</div>

{{-- Modales pour chaque produit (en dehors du tableau) --}}
@foreach($produits as $produit)
<div class="modal fade" id="approvisionnerModal{{ $produit->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $produit->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('approvisionnement.store') }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="produit_id" value="{{ $produit->id }}">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $produit->id }}">Approvisionner : {{ $produit->nom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="quantite{{ $produit->id }}" class="form-label">Quantité à ajouter</label>
                    <input type="number" name="quantite" id="quantite{{ $produit->id }}" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="nom_fournisseur{{ $produit->id }}" class="form-label">Nom du fournisseur</label>
                    <input type="text" name="nom_fournisseur" id="nom_fournisseur{{ $produit->id }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="prix_achat{{ $produit->id }}" class="form-label">Prix d'achat (GNF)</label>
                    <input type="number" step="0.01" name="prix_achat" id="prix_achat{{ $produit->id }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="date_approvisionnement{{ $produit->id }}" class="form-label">Date d'approvisionnement</label>
                    <input type="date" name="date_approvisionnement" id="date_approvisionnement{{ $produit->id }}" class="form-control" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>
    </div>
</div>

@endforeach
@endsection 
