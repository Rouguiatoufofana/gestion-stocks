<?php

// database/seeders/CategoriesSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        Categorie::create(['nom' => 'Vêtements']);
        Categorie::create(['nom' => 'Chaussures']);
        Categorie::create(['nom' => 'Accessoires']);
    }
}

