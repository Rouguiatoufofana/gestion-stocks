<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approvisionnement extends Model
{
    protected $fillable = ['produit', 'quantite', 'fournisseur', 'date'];
}
