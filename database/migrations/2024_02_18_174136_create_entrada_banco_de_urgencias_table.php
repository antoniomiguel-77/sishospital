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
        Schema::create('entrada_banco_de_urgencias', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Paciente::class);
            $table->string('acompanhante')->nullable();
            $table->date('data');
            $table->time('hora');
            $table->string('proveniencia')->nullable();
            $table->string('area');
            $table->string('telefone')->nullable();
            $table->enum('situacao',['Aguardando Triagem','Aguardando Atendimento','Aguardando Decisão']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_banco_de_urgencias');
    }
};
