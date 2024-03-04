<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDeExame extends Model
{
    use HasFactory;
    protected $table = '';
    protected $primaryKey = 'id';
    protected $fillable = [
        'triagem_id',
        'medico_id',
        'laboratorio',
        'exames',
    ];
    protected $guarded = ['id'];

    protected $casts = [
        'exames'=>'array'
    ];
}
