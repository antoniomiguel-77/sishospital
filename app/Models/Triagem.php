<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triagem extends Model
{
    use HasFactory;

    protected $table ='triagems';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    protected $fillable = [
        'paciente_id',
        'acompanhante',
        'dataEntrada',
        'horaEntrada',
        'escalaDeManchester',
        'respiracao',
        'pulso',
        'temperatura',
        'peso',
        'proveniencia',
        'tensaoDiastolica',
        'tensaoSistolica',
        'notaDeTriagem',
        'encaminharPara',
        'telefone',
        'enfermeiro_id'
  
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }
    public function enfermeiro()
    {
        return $this->belongsTo(Enfermeiro::class, 'enfermeiro_id', 'id');
    }
}
