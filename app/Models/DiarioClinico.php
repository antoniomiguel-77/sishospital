<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiarioClinico extends Model
{
    use HasFactory;
    protected $fillable =['descricao','medico_id','triagem_id'];
    protected $table = 'diario_clinicos';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];


    
    
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id', 'id');
    }
    public function triagem()
    {
        return $this->belongsTo(Triagem::class, 'triagem_id', 'id');
    }
}
