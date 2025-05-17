@extends('administration.base')

@section('content')
<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Liste des produits</h3>
        <a href="{{ route('produits.create') }}" class="btn btn-primary">+ Ajouter un produit</a>
    </div>

    <main class="container-fluid px-5">
        @if($produits->contains(fn($p) => $p->quantite_stock > 0 && $p->quantite_stock < 10))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Attention !',
                html: 'Certains produits sont <strong>bientôt en rupture de stock</strong> (moins de 10 unités).',
                confirmButtonColor: '#f0ad4e',
                confirmButtonText: 'Compris'
            });
        });
    </script>
@endif

        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

        <div class="card">
            <div class="card-body">
                @if($produits->isEmpty())
                    <p class="text-muted">Aucun produit trouvé.</p>
                @else

                <form method="GET" action="{{ route('produits.index') }}" class="mb-3 d-flex" role="search">
    <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control me-2" placeholder="Rechercher un produit ou une catégorie">
    <button type="submit" class="btn btn-outline-primary">Rechercher</button>
</form>

                <table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Prix (GNF)</th>
            <th>Quantité en stock</th>
            <th>Seuil</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="produits-body">
        @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->categorie->nom ?? 'Non défini' }}</td>
                <td>{{ number_format($produit->prix, 0, ',', ' ') }}</td>

                <td>
                    @if($produit->quantite_stock == 0)
                        <span class="badge bg-danger">Rupture de stock</span>
                    @elseif($produit->quantite_stock < 10)
                        <span class="badge bg-warning text-dark">Stock bas ({{ $produit->quantite_stock }})</span>
                    @else
                        {{ $produit->quantite_stock }}
                    @endif
                </td>

                <td>{{ $produit->seuil }}</td>

                <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <button onclick="confirmerModification('{{ route('produits.edit', $produit) }}')" class="btn btn-sm btn-warning d-inline-flex align-items-center">
                            <i class="fas fa-edit me-1"></i> <span>Modifier</span>
                        </button>

                        <button onclick="confirmerSuppression({{ $produit->id }})" class="btn btn-sm btn-danger d-inline-flex align-items-center">
                            <i class="fas fa-trash me-1"></i> <span>Supprimer</span>
                        </button>

                        <form id="form-suppression-{{ $produit->id }}" action="{{ route('produits.destroy', $produit) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


                              <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
    {{ $produits->appends(request()->query())->links() }}
        </div>
                @endif
            </div>
        </div>
    </main>
</div>

<!-- SweetAlert Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmerSuppression(produitId) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-suppression-' + produitId).submit();
            }
        });
    }

    function confirmerModification(url) {
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous allez modifier ce produit.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Oui, modifier',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
@endsection
