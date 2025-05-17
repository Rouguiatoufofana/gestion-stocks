<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    use HasFactory;

    protected $fillable = [
    'produit_id',
    'quantite',
    'nom_fournisseur',
    'prix_achat', // ← IL FAUT que cette ligne soit là
    'date_approvisionnement',
    
];
    protected $casts = [
        'date_approvisionnement' => 'datetime',
    ];

    /**
     * Relation : Un approvisionnement concerne un seul produit.
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}

