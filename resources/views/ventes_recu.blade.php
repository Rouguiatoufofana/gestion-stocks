@extends('administration.base')
  @section('content')
<h2>🧾 Reçu de Vente</h2>
<p><strong>Produit :</strong> {{ $vente->produit }}</p>
<p><strong>Quantité :</strong> {{ $vente->quantite }}</p>
<p><strong>Prix Unitaire :</strong> {{ $vente->prix_unitaire }} GNF</p>
<p><strong>Total :</strong> {{ $vente->total }} GNF</p>
<p><strong>Date :</strong> {{ $vente->created_at->format('d/m/Y à H:i') }}</p>
 @endsection