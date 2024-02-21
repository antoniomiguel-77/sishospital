<?php

namespace App\Livewire\Medico;

use App\Models\Medico;
use App\Models\Triagem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AguardandoDecisaoMedica extends Component
{
   public $pesquisar,$mostrar;
    public function render()
    {
        return view('livewire.medico.aguardando-decisao-medica',[
            'decisoesPendentes'=>$this->listarPacientesAguardandoDecisao($this->pesquisar,$this->mostrar)
        ])->layout('layouts.medico.app');
    }
    public function listarPacientesAguardandoDecisao($pesquisar,$mostrar)
    {
        try {
                        
            
            $medico = Medico::find(auth()->user()->medico->id ?? '1');

 

           
            if ($this->pesquisar != null) {
                return Triagem::with('paciente')
                ->whereDate('created_at', '=', DB::raw('curdate()'))
                ->where('nomeCompleto','%'.$pesquisar.'%')
                ->where('encaminharPara','=',$medico->departamento->descricao)
                ->where('atendido','=','Sim')
                ->orderBy('escalaDeManchester','asc')
                ->limit($mostrar)
                ->get();
            }else{

                return Triagem::with('paciente')
                ->whereDate('created_at', '=', DB::raw('curdate()'))
                ->where('encaminharPara','=',$medico->departamento->descricao)
                ->where('atendido','=','Sim')
                ->orderBy('escalaDeManchester','asc')
                ->limit($mostrar)
                ->get();
            }

        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
}
