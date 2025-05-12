<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     // Exemple dans create_ventes_table.php
Schema::create('ventes', function (Blueprint $table) {
    $table->id();
    $table->string('produit');
    $table->integer('quantite');
    $table->decimal('prix_unitaire', 8, 2);
    $table->decimal('total', 8, 2);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
