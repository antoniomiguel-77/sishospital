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
        Schema::create('triagems', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Paciente::class);
            $table->foreignIdFor(\App\Models\Enfermeiro::class);
            $table->string('acompanhante');
            $table->date('dataEntrada');
            $table->time('horaEntrada');
            $table->string('escalaDeManchester');
            $table->string('respiracao');
            $table->string('pulso');
            $table->string('temperatura');
            $table->string('peso');
            $table->string('tensaoDiastolica');
            $table->string('tensaoSistolica');
            $table->longText('notaDeTriagem');
            $table->string('proveniencia');
            $table->string('encaminharPara')->nullable();
            $table->string('telefone');
            $table->boolean('estado')->default(0);
            $table->enum('atendido',['Sim','Não'])->default('Não')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triagems');
    }
};
