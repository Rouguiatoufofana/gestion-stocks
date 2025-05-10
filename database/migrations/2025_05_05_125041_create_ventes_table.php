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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id('id_vente');
            $table->string('reference_produit');
            $table->integer('quantite_vente');
            $table->decimal('prix_vente', 10, 2);
            $table->string('nom_client');
            $table->timestamps();
        
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');

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
