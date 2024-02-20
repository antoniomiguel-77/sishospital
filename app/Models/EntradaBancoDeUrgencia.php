<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaBancoDeUrgencia extends Model
{
    use HasFactory;
    protected $table ='entrada_banco_de_urgencias';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    protected $fillable = [
        'paciente_id',
        'acompanhante',
        'acompanhante',
        'data',
        'hora',
        'proveniencia',
        'area',
        'telefone',
        'situacao',
    ];


   
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id', 'id');
    }
}
