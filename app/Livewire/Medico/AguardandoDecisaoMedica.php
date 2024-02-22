<?php

namespace App\Livewire\Medico;

use App\Models\Medico;
use App\Models\{Triagem, ObservacaoMedica as ModelObservacaoMedica};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AguardandoDecisaoMedica extends Component
{
   public $pesquisar,$mostrar,
   $queixasPrincipais,$assistenciaPreHospitalar,
   $diagnosticoDeEntrada,$dataObservacao,
   $horaObservacao,$observacaoSumaria;
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

 
        if($medico){
    
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


    public function pegarObservacaoMedica($id)
    {
        try {
            $observacaoMedica =  ModelObservacaoMedica::where('triagem_id',$id)->first();
            $this->queixasPrincipais = $observacaoMedica->queixasPrincipais;
            $this->assistenciaPreHospitalar = $observacaoMedica->assistenciaPreHospitalar;
            $this->diagnosticoDeEntrada = $observacaoMedica->diagnosticoDeEntrada;
            $this->dataObservacao = Carbon::parse($observacaoMedica->dataObservacao)->format('d-m-Y');
            $this->horaObservacao = Carbon::parse($observacaoMedica->horaObservacao)->format('H:i');
            $this->observacaoSumaria = $observacaoMedica->observacaoSumaria;
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


    public function limparCampos(){
        try {
            $this->queixasPrincipais = '';
            $this->assistenciaPreHospitalar = '';
            $this->diagnosticoDeEntrada = '';
            $this->dataObservacao = '';
            $this->horaObservacao = '';
            $this->observacaoSumaria = '';
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
