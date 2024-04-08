<?php

namespace App\Livewire\Medico;

use App\Models\Exame;
use App\Models\PedidoDeExame;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ListarExameComponent extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.medico.listar-exame-component',[
            'dados'=>$this->pegarListaDeExames()
        ])->layout('layouts.medico.app');
    }

    public function pegarListaDeExames()
    {
        try {
            return PedidoDeExame::orderBy('id','desc')
            ->where('medico_id',auth()->user()->medico->id)
            ->get();
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
}
