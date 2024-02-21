<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservacaoMedica extends Model
{
    use HasFactory;
    protected $fillable = [
        'triagem_id',
        'queixasPrincipais',
        'assistenciaPreHospitalar',
        'diagnosticoDeEntrada',
        'dataObservacao',
        'horaObservacao',
        'observacaoSumaria',
    ];


    
    public function triagem()
    {
        return $this->hasOne(Triagem::class, 'triagem_id', 'id');
    }
}
