<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    use HasFactory;
    protected $table ='especialidades';
    protected $primaryKey ='id';
    protected $guarded = ['id'];

    protected $fillable = [
        'descricao',
    ];
}
