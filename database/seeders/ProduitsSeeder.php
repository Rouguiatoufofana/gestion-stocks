<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Produit;

class ProduitsSeeder extends Seeder
{
    public function run(): void
    {
        $categorieVetements = Categorie::where('nom', 'Vêtements')->first();

        if ($categorieVetements) {
            Produit::create([
                'reference_produit' => 'REF001',
                'nom' => 'T-shirt Homme',
                'quantite_stock' => 200,
                'prix' => 2500,
                'categorie_id' => $categorieVetements->id,
            ]);
        } else {
            $this->command->error("Catégorie 'Vêtements' non trouvée. Veuillez exécuter le CategoriesSeeder d'abord.");
        }
    }
}
