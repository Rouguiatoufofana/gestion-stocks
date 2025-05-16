@extends('administration.base')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">État du Stock</h3>

{{-- Filtres --}}
<form method="GET" action="{{ route('etat.stocks') }}" class="d-flex align-items-center">
    <select name="filtre" class="form-select form-select-lg me-3 fs-5" style="min-width: 220px;" onchange="this.form.submit()">
        <option value="">Tous les produits</option>
        <option value="critiques" {{ request('filtre') === 'critiques' ? 'selected' : '' }}>
            Stock critique
        </option>
    </select>
    <noscript>
        <button class="btn btn-primary btn-lg px-4" type="submit">Filtrer</button>
    </noscript>

    
</form>

    </div>

    {{-- Notification SweetAlert --}}
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    {{-- Produits en rupture rapide --}}
    @if($produitsRupture->isNotEmpty())
        <div class="mb-4">
            <label for="produit" class="form-label fw-semibold">Produits en stock critique :</label>
            <select class="form-select" id="produit" name="produit">
                @foreach($produitsRupture as $produit)
                    <option value="{{ $produit->id }}">
                        {{ $produit->nom }} — {{ $produit->quantite_stock }} en stock
                    </option>
                @endforeach
            </select>
        </div>
    @endif

    {{-- Tableau des produits --}}
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Liste des produits</h5>
        </div>
        <div class="card-body p-0">
            @if($produits->isEmpty())
                <div class="p-4 text-muted">Aucun produit disponible.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Quantité</th>
                                <th>Prix (GNF)</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                                <tr>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->categorie->nom ?? 'Non défini' }}</td>
                                    <td>{{ $produit->quantite_stock }}</td>
                                    <td>{{ number_format($produit->prix, 0, ',', ' ') }}</td>
                                    <td>
                                        <span class="badge {{ $produit->quantite_stock < 5 ? 'bg-warning text-dark' : 'bg-success' }}">
                                            {{ $produit->quantite_stock < 5 ? 'Stock faible' : 'Stock OK' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#approvisionnerModal{{ $produit->id }}">
                                            Approvisionner
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-3 d-flex justify-content-center">
                    {{ $produits->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modales d'approvisionnement --}}
    @foreach($produits as $produit)
        <div class="modal fade" id="approvisionnerModal{{ $produit->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $produit->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('approvisionnement.store') }}" method="POST" class="modal-content">
                    @csrf
                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $produit->id }}">Approvisionner {{ $produit->nom }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <label for="quantite{{ $produit->id }}" class="form-label">Quantité</label>
                        <input type="number" name="quantite" id="quantite{{ $produit->id }}" class="form-control" min="1" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
