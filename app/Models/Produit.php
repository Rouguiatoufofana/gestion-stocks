<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'reference_produit',
        'design_produit',
        'categorie_id',
        'prix',
        'quantite_stock',
        'seuil'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function ventes()
{
    return $this->hasMany(Vente::class);
}

}


