<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendente extends Model
{
    use HasFactory;

    protected $table = 'atendentes';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'nomeCompleto',
        'dataDeNascimento',
       'idade',
        'nacionalidade',
        'nomeDoPai',
        'nomeDaMae',
        'contribuente',
        'provincia',
        'municipio',
        'bairro',
        'endereco',
        'telefone',
        'email',
        'genero',
        'estado',
    ];
}
