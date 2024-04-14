<?php

use App\Models\Medico;
use App\Models\Paciente;
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
        Schema::create('diario_clinicos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao',255);
            $table->foreignIdFor(Medico::class);
            $table->foreignIdFor(Triagem::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diario_clinicos');
    }
};
