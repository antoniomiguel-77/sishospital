<?php

use App\Models\Medico;
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
        Schema::create('registro_de_altas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Triagem::class);
            $table->foreignIdFor(Medico::class);
            $table->string('condicaoDeSaude');
            $table->string('recomendacao');
            $table->string('orientacao');
            $table->string('diagnosticoDeEntrada');
            $table->string('diagnosticoDeSaida');
            $table->enum('estado',['Curado','Melhorado','Mesmo Estado','Piorado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_de_altas');
    }
};
