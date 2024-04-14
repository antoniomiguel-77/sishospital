<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroDeAlta extends Model
{
    use HasFactory;
    protected $table = 'registro_de_altas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'triagem_id',
        'medico_id',
        'condicaoDeSaude',
        'recomendacao',
        'orientacao',
        'diagnosticoDeEntrada',
        'diagnosticoDeSaida',
        'estado',
    ];
    protected $guarded = ['id'];



 
    public function triagens()
    {
        return $this->belongsTo(\App\Models\Triagem::class, 'triagem_id', 'id');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id', 'id');
    }
}
