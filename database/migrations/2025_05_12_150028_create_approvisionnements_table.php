<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->id();
            $table->string('produit'); // Nom du produit approvisionné
            $table->integer('quantite'); // Quantité reçue
            $table->string('fournisseur')->nullable(); // Nom du fournisseur
            $table->date('date'); // Date d’approvisionnement
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approvisionnements');
    }
};
