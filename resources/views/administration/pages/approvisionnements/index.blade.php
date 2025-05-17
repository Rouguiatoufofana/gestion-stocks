@extends('admin.base')
@section('content')
<div class="container">
    <h1>Historique des approvisionnements</h1>
    <a href="{{ route('approvisionnements.create') }}" class="btn btn-primary mb-3">Nouvel approvisionnement</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Produit</th><th>Quantité</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
         @foreach ($approvisionnements as $appro)
<tr>
    <td>{{ $appro->produit->nom }}</td>
    <td>{{ $appro->quantite }}</td>
    <td>{{ $appro->date_approvisionnement }}</td>
    <td>
        <a href="{{ route('approvisionnements.edit', $appro->id) }}" class="btn btn-warning btn-sm">Modifier</a>
        <form action="{{ route('approvisionnements.destroy', $appro->id) }}" method="POST" style="display:inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
        </form>
        <a href="{{ url('/recu/approvisionnement/' . $appro->id) }}" target="_blank" class="btn btn-info btn-sm">PDF</a>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>
@endsection