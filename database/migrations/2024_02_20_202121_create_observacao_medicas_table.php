<?php

use App\Models\Triagem;
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
        Schema::create('observacao_medicas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Triagem::class);
            $table->longText('queixasPrincipais');
            $table->longText('assistenciaPreHospitalar');
            $table->longText('diagnosticoDeEntrada');
            $table->date('dataObservacao');
            $table->time('horaObservacao');
            $table->longText('observacaoSumaria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observacao_medicas');
    }
};
