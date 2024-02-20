<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    protected $table ='medicos';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    protected $fillable = [
        'user_id',
        'especialidade_id',
        'departamento_id',
        'nomeCompleto',
        'dataDeNascimento',
        'idade',
        'nacionalidade',
        'imagem',
        'contribuente',
        'provincia',
        'municipio',
        'numeroOrdem',
        'dataDeVinculo',
        'telefone',
        'genero',
        'estado',
        'biografia',
        'email',
        'documentosAssociados',
    ];

    public function especialidade()
    {
        return $this->belongsTo(\App\Models\Especialidade::class, 'especialidade_id', 'id');
    }
    public function departamento()
    {
        return $this->belongsTo(\App\Models\Departamento::class, 'departamento_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
