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
      Schema::create('extrait_avec_numero', function (Blueprint $table) {
    $table->string('numero_demande', 100)->primary()->default('ENA0000'); // Clé personnalisée avec le préfixe "EAN"
    $table->string('nom_enfant', 100);
    $table->date('date_naissance');
    $table->string('nom_pere', 100);
    $table->string('nom_mere', 100);
    $table->string('numero_extrait', 100);
    $table->string('contact_1', 14);
    $table->string('contact_2', 14)->nullable();
    $table->string('email', 100)->nullable();
    $table->string('lieu_habitation', 150);
    $table->string('quartier', 100);
    $table->string('ville', 100)->default('Bouake');
    $table->string('mairie', 100)->default('Mairie de Bouake');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extrait_avec_numero');
    }
};
