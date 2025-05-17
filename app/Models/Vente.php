<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// app/Models/Vente.php

class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'produit_id',
        'quantite',
        'prix_vente',
        'date_vente',
    ];

    protected $casts = [
        'date_vente' => 'datetime',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}


