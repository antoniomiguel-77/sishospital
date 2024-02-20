<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $table ='pacientes';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    protected $fillable = [
        'nomeCompleto',
        'dataDeNascimento',
        'idade',
        'nacionalidade',
        'imagem',
        'nomeDoPai',
        'nomeDaMae',
        'contribuente',
        'provincia',
        'municipio',
        'bairro',
        'endereco',
        'telefone',
        'genero',
        'estado',
        'biografia',
        'email',
        'grupoSanguinio',
  
    ];

   
    public function triagens()
    {
        return $this->hasMany(\App\Models\Triagem::class, 'paciente_id', 'id');
    }
}
