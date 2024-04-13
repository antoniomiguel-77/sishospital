<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDeExame extends Model
{
    use HasFactory;
    protected $table = 'pedido_de_exames';
    protected $primaryKey = 'id';
    protected $fillable = [
        'triagem_id',
        'medico_id',
        'laboratorio',
        'exames',
        'descricao',
        'estado',
    ];
    protected $guarded = ['id'];

    protected $casts = [
        'exames'=>'array'
    ];

 
    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'paciente_id', 'id');
    }
}
