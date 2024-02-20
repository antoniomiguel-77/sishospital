<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable =['descricao','telefone'];
    protected $table = 'departamentos';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

}
