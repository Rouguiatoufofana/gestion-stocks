<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vente;
use App\Models\Approvisionnement;

class PdfController extends Controller
{
    public function venteRecu($id)
    {
        require_once base_path('vendor/setasign/fpdf/fpdf.php');

        $vente = Vente::with('produit')->findOrFail($id);
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,10,'Recu de Vente',0,1,'C');

        $pdf->SetFont('Arial','',12);
        $pdf->Ln(5);
        $pdf->Cell(0,10,'Produit : ' . $vente->produit->nom,0,1);
        $pdf->Cell(0,10,'Quantite : ' . $vente->quantite,0,1);
        $pdf->Cell(0,10,'Prix unitaire : ' . $vente->produit->prix_vente . ' Fcfa',0,1);
        $pdf->Cell(0,10,'Total : ' . ($vente->quantite * $vente->produit->prix_vente) . ' Fcfa',0,1);
        $pdf->Cell(0,10,'Date : ' . $vente->date_vente,0,1);

        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="recu_vente_'.$id.'.pdf"');
    }

    public function approvisionnementRecu($id)
    {
        require_once base_path('vendor/setasign/fpdf/fpdf.php');

        $appro = Approvisionnement::with('produit')->findOrFail($id);
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(0,10,"Recu d'Approvisionnement",0,1,'C');

        $pdf->SetFont('Arial','',12);
        $pdf->Ln(5);
        $pdf->Cell(0,10,'Produit : ' . $appro->produit->nom,0,1);
        $pdf->Cell(0,10,'Quantite : ' . $appro->quantite,0,1);
        $pdf->Cell(0,10,'Date : ' . $appro->date_approvisionnement,0,1);

        return response($pdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="recu_appro_'.$id.'.pdf"');
    }
}
