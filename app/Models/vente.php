<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['produit', 'quantite', 'prix_unitaire', 'total'];
}
