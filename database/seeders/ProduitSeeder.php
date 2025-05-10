<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Produit;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        $categorie = \App\Models\Categorie::firstOrCreate(['nom' => 'Accessoires de vêtements']);
    
        $produits = [
            ['nom' => 'Ceinture en cuir', 'quantite_stock' => 3, 'prix' => 5000],
            ['nom' => 'Chapeau de paille', 'quantite_stock' => 0, 'prix' => 4500],
            ['nom' => 'Écharpe en laine', 'quantite_stock' => 2, 'prix' => 6500],
            ['nom' => 'Gants en coton', 'quantite_stock' => 15, 'prix' => 3000],
            ['nom' => 'Lunettes de soleil', 'quantite_stock' => 1, 'prix' => 10000],
        ];
    
        foreach ($produits as $p) {
            \App\Models\Produit::create([
                'nom' => $p['nom'],
                'reference_produit' => uniqid('REF-'),
                'design_produit' => $p['nom'] . ' design',
                'categorie_id' => $categorie->id,
                'prix' => $p['prix'],
                'quantite_stock' => $p['quantite_stock'],
                'seuil' => 5,
            ]);
        }
    }
    
}
