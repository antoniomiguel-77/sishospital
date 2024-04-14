<?php

namespace App\Livewire\Administrador;

use App\Models\Atendente;
use App\Models\Enfermeiro;
use App\Models\EntradaBancoDeUrgencia;
use App\Models\Medico;
use App\Models\Paciente;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.administrador.home-component',[
            'medicos'=>Medico::count(),
            'enfermeiros'=>Enfermeiro::count(),
            'atendentes'=>Atendente::count(),
            'pacientes'=>Paciente::count(),
            'entradas'=>EntradaBancoDeUrgencia::whereBetween('created_at',[date('Y-m-d').' 00:00:00',date('Y-m-d').' 23:59:59'])->count(),
        ])->layout('layouts.administrador.app');
    }
}
