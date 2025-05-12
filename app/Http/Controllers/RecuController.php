<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Approvisionnement;
use Barryvdh\DomPDF\Facade\Pdf;

class RecuController extends Controller
{
    // Générer le reçu PDF d'une vente
    public function vente($id)
    {
        $vente = Vente::findOrFail($id);
        $pdf = Pdf::loadView('ventes_recu', compact('vente'));
        return $pdf->download('recu_vente.pdf');
    }

    // Générer le reçu PDF d'un approvisionnement
    public function approvisionnement($id)
    {
        $approvisionnement = Approvisionnement::findOrFail($id);
        $pdf = Pdf::loadView('approvisionnements_recu', compact('approvisionnement'));
        return $pdf->download('recu_approvisionnement.pdf');
    }
}
