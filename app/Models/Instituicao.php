<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    use HasFactory;
    protected $table = 'instituicaos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'descricao',
        'telefone',
        'email',
        'pais',
        'provincia',
        'municipio',
        'endereco',
        'logotipo',
    ];
    protected $guarded = ['id'];
}
