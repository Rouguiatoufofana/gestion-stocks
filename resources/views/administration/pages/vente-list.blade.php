@extends('administration.base')

@section('content')
<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Liste des ventes</h3>
        <a href="{{ route('ventes.create') }}" class="btn btn-primary">+ Nouvelle vente</a>
    </div>

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
            @if($ventes->isEmpty())
                <p class="text-muted">Aucune vente enregistrée.</p>
            @else
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire (GNF)</th>
                            <th>Total (GNF)</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventes as $vente)
                            <tr>
                                <td>{{ $vente->produit->nom ?? 'Produit supprimé' }}</td>
                                <td>{{ $vente->quantite }}</td>
                                <td>{{ number_format($vente->prix_vente, 0, ',', ' ') }}</td>
                                <td>{{ number_format($vente->quantite * $vente->prix_vente, 0, ',', ' ') }}</td>
                                <td>{{ $vente->date_vente->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('ventes.destroy', $vente) }}" method="POST" onsubmit="return confirm('Supprimer cette vente ?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $ventes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- SweetAlert script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
