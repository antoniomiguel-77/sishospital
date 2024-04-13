<?php

namespace App\Livewire\Medico;

use App\Models\Exame;
use App\Models\PedidoDeExame;
use App\Models\Triagem;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ListarExameComponent extends Component
{
    use LivewireAlert;
    public $paciente, $mostrar = 5,$triagem,$estado = 0;
    public function render()
    {
        return view('livewire.medico.listar-exame-component',[
            'dados'=>$this->pegarListaDeExames(),
            'triagens'=>$this->pegarTriangens()
        ])->layout('layouts.medico.app');
    }

    public function pegarListaDeExames()
    {
        try {
            if ($this->triagem) {
              
                return PedidoDeExame::orderBy('id','desc')
                ->where('medico_id',auth()->user()->medico->id)
                ->where('triagem_id',$this->triagem)
                ->where('estado',$this->estado)
                ->limit($this->mostrar)
                ->get();
            }
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
    public function pegarTriangens()
    {
        try {
            return Triagem::orderBy('id','desc')
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
