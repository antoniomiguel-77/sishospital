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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nomeCompleto');
            $table->date('dataDeNascimento')->nullable();
            $table->integer('idade')->nullable();
            $table->string('nacionalidade')->nullable();
            $table->string('nomeDoPai')->nullable();
            $table->string('nomeDaMae')->nullable();
            $table->string('contribuente')->nullable();
            $table->string('grupoSanguinio')->nullable();
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('bairro')->nullable();
            $table->string('endereco')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->enum('genero',['Masculino','Femenino'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
