<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('reference_produit')->unique();
            $table->string('design_produit')->nullable();
            $table->foreignId('categorie_id')->constrained('categories')->onDelete('cascade');
            $table->decimal('prix', 10, 2);
            $table->integer('quantite_stock');
            $table->integer('seuil')->default(5);
            $table->timestamps();
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
