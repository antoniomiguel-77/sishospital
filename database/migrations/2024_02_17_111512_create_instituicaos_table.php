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
        Schema::create('instituicaos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('telefone');
            $table->string('email');
            $table->string('pais');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('endereco');
            $table->string('logotipo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituicaos');
    }
};
