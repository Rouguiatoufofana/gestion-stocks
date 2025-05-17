<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vente;
class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function exportPDF($id) {
    $vente = Vente::findOrFail($id);
    $pdf = new \Fpdf();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,'Reçu de Vente',0,1,'C');
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,10,"Produit : {$vente->produit->nom}",0,1);
    $pdf->Cell(0,10,"Quantité : {$vente->quantite}",0,1);
    $pdf->Cell(0,10,"Total : {$vente->total} FCFA",0,1);
    $pdf->Output();
    exit;
}
}
