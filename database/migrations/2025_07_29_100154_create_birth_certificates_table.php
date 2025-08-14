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
        Schema::create('birth_certificates', function (Blueprint $table) {
        $table->string('asking_number', 100)->primary()->default('ENA0000'); // Clé personnalisée avec le préfixe "EAN"
        $table->string('child_name', 100);
        $table->date('child_birthday');
        $table->string('father_name', 100)->nullable();
        $table->string('mother_name', 100)->nullable();
        $table->string('birth_certificate_num', 50)->nullable();
        $table->string('phone_num_1', 20);
        $table->string('phone_num_2', 20)->nullable();
        $table->string('email', 150);
        $table->string('residence', 100);
        $table->string('neighborhood', 80);
        $table->string('city', 80);
        $table->string('municipal_office', 100);
        $table->string('number_of_copies', 50);
        $table->enum('status', ['pending', 'processed'])->default('pending');
        $table->string('picture')->nullable(); // Chemin de l'image
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_certificates');
    }
};
