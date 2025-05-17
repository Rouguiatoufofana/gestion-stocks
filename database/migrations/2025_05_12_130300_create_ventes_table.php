<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('ventes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produit_id')->constrained()->onDelete('cascade');
        $table->integer('quantite');
        $table->decimal('prix_vente', 12, 2); // prix unitaire au moment de la vente
        $table->timestamp('date_vente')->default(DB::raw('CURRENT_TIMESTAMP'));
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
