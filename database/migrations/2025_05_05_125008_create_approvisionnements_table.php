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
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->id('id_approvisionnement');
            $table->string('reference_produit');
            $table->integer('quantite');
            $table->decimal('prix_achat', 10, 2);
            $table->date('date_approvisionnement');
            $table->string('nom_fournisseur');
            
            $table->timestamps();
        
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvisionnements');
    }
};
