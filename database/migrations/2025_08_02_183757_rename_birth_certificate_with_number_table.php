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
        Schema::rename('birth_certificate_with_nums', 'birth_certificate');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('birth_certificate', 'birth_certificate_with_nums');

    }
};
