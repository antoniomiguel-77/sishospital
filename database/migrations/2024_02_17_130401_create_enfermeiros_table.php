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
        Schema::create('enfermeiros', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Especialidade::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Departamento::class);
            $table->string('nomeCompleto');
            $table->date('dataDeNascimento');
            $table->integer('idade');
            $table->string('nacionalidade');
            $table->string('imagem');
            $table->string('contribuente');
            $table->string('provincia');
            $table->string('municipio');
            $table->date('dataDeVinculo');
            $table->string('numeroOrdem');
            $table->string('telefone');
            $table->string('email');
            $table->string('documentosAssociados');
            $table->enum('genero',['Masculino','Femenino']);
            $table->enum('estado',['Activo','Inativo'])->default('Activo');
            $table->text('biografia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfermeiros');
    }
};
