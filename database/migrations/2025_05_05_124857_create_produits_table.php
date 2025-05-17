<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
 public function up()
 {
    Schema::create('produits', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('reference_produit')->unique();
        $table->string('design_produit');
        $table->foreignId('categorie_id')->constrained()->onDelete('cascade'); // Liaison avec la table 'categories'
        $table->decimal('prix', 8, 2);
        $table->integer('quantite_stock');
        $table->integer('seuil');
        $table->timestamps();
    });
 }
};
