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
        Schema::create('pedido_de_exames', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Triagem::class);
            $table->foreignIdFor(Medico::class);
            $table->string('laboratorio');
            $table->json('exames');
            $table->boolean('estado')->default(0)->nullable();
            $table->longText('descricao');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_de_exames');
    }
};
