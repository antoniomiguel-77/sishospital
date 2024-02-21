<?php

namespace App\Livewire\Medico;

use App\Models\Medico;
use App\Models\{Triagem,ObservacaoMedica as ModelObservacaoMedica};
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class PacienteAguardandoAtendimento extends Component
{
    use LivewireAlert;
    public $pesquisar,$mostrar,$dataInicial,$dataFinal,$triagemId;
    public $paciente,$telefone,$acompanhante,$idade,$genero,$dataEntrada,
    $horaEntrada,$pulso,$peso,$respiracao,$triagemRealizada,$escalaDeManchester,
    $temperatura,$tensaoDiastolica,$tensaoSistolica,$enfermeiro,$queixasPrincipais,
    $observacaoSumaria,$diagnosticoEntrada,$assistenciaPreHospitalar;
    public $listeners = ['fecharModal'=>'fecharModal','registrarObservacaoMedica'=>'registrarObservacaoMedica'];
    public function render()
    {
        return view('livewire.medico.paciente-aguardando-atendimento',[
            'atendimentoPendentes'=>$this->listarPacientesAguardandoAtendimento($this->pesquisar,$this->mostrar,$this->dataInicial,$this->dataFinal)

        ])->layout('layouts.medico.app');
    }

  

    public function listarPacientesAguardandoAtendimento($pesquisar,$mostrar,$dataInicial,$dataFinal)
    {
        try {
                        
            
            $medico = Medico::find(auth()->user()->medico->id ?? '1');

 
        if($medico){
    
            if ($this->pesquisar != null) {
                return Triagem::with('paciente')
                ->whereDate('created_at', '=', DB::raw('curdate()'))
                ->where('nomeCompleto','%'.$pesquisar.'%')
                ->where('encaminharPara','=',$medico->departamento->descricao)
                ->where('atendido','=','Não')
                ->orderBy('escalaDeManchester','asc')
                ->limit($mostrar)
                ->get();
            }else{

                return Triagem::with('paciente')
                ->whereDate('created_at', '=', DB::raw('curdate()'))
                ->where('encaminharPara','=',$medico->departamento->descricao)
                ->where('atendido','=','Não')
                ->orderBy('escalaDeManchester','asc')
                ->limit($mostrar)
                ->get();
            }
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

   
    public function pegarDadosDaTriagem($id)
    {
        try {
            $triagem = Triagem::find($id);
        
            $this->paciente = $triagem->paciente->nomeCompleto ?? 'NÃO DEFINIDO';
            $this->triagemId = $triagem->id;
            $this->acompanhante = $triagem->acompanhante ?? 'NÃO DEFINIDO';
            $this->telefone = $triagem->telefone ?? 'NÃO DEFINIDO';
            $this->idade = $triagem->paciente->idade ?? 'NÃO DEFINIDO';
            $this->genero = $triagem->paciente->genero ?? 'NÃO DEFINIDO';
            $this->dataEntrada = $triagem->dataEntrada ?? 'NÃO DEFINIDO';
            $this->horaEntrada = $triagem->pulso ?? 'NÃO DEFINIDO';
            $this->pulso = $triagem->pulso;
            $this->peso = $triagem->peso;
            $this->respiracao = $triagem->respiracao ?? 'NÃO DEFINIDO';
            $this->temperatura = $triagem->temperatura ?? 'NÃO DEFINIDO';
            $this->tensaoDiastolica = $triagem->tensaoDiastolica ?? 'NÃO DEFINIDO';
            $this->tensaoSistolica = $triagem->tensaoSistolica ?? 'NÃO DEFINIDO';
            $this->escalaDeManchester = $triagem->escalaDeManchester ?? 'NÃO DEFINIDO';
            $this->enfermeiro = $triagem->enfermeiro->nomeCompleto ?? 'NÃO DEFINIDO';
      
           

           

            
        } catch (\Throwable $th) {
             
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
        }
     

        public function limparCampos()
        {
            try {
                $this->paciente = '';
                $this->triagemId = '';
                $this->acompanhante = '';
                $this->telefone = '';
                $this->idade = '';
                $this->genero = '';
                $this->dataEntrada = '';
                $this->horaEntrada = '';
                $this->pulso = '';
                $this->peso = '';
                $this->respiracao = '';
                $this->temperatura = '';
                $this->tensaoDiastolica = '';
                $this->tensaoSistolica = '';
                $this->escalaDeManchester = '';
                $this->enfermeiro = '';
                $this->queixasPrincipais = '';
                $this->observacaoSumaria = '';
                $this->diagnosticoEntrada = '';
                $this->assistenciaPreHospitalar = '';
            } catch (\Throwable $th) {
                $this->alert('error', 'FALHA', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text' => 'Falha ao realizar operação',
                ]);
            }
        }


        public function registrarObservacaoMedica()
        {
            $this->validate(
            ['queixasPrincipais'=>'required','diagnosticoEntrada'=>'required','assistenciaPreHospitalar'=>'required','observacaoSumaria'=>'required'],
            ['queixasPrincipais.required'=>'Obrigatório','diagnosticoEntrada.required'=>'Obrigatório','assistenciaPreHospitalar.required'=>'Obrigatório','observacaoSumaria.required'=>'Obrigatório']);
        
            DB::beginTransaction();
            try {
              
                $triagem = Triagem::find($this->triagemId);
           

                ModelObservacaoMedica::create([
                    'triagem_id'=>$this->triagemId,
                    'queixasPrincipais'=>$this->queixasPrincipais,
                    'assistenciaPreHospitalar'=>$this->assistenciaPreHospitalar,
                    'diagnosticoDeEntrada'=>$this->diagnosticoEntrada,
                    'dataObservacao'=>date('Y-m-d'),
                    'horaObservacao'=>date('H:i'),
                    'observacaoSumaria'=>$this->observacaoSumaria,
                ]);
   
               $triagem->atendido = 'Sim';
               $triagem->save();
   
               $this->alert('success', 'SUCESSO', [
                   'position' => 'top-end',
                   'toast' => true,
                   'timer' => 2000,
                   'text'=>'Operação Realizada com sucesso'
               ]);
   
                    $this->limparCampos();
                    $this->dispatch('fecharModal');
              
                DB::commit();
            } catch (\Throwable $th) {
                dd($th->getMessage());
               DB::rollback();
                $this->alert('error', 'FALHA', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text' => 'Falha ao realizar operação',
                ]);
            }
       }

       public function confirmarRegistro(){
        try{
            $this->alert('question', 'AVISO', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'text' => 'Deseja Realmente Registrar essa observação Médica.',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Registrar',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'registrarObservacaoMedica' 
            ]);
        }catch(Exception $ex){
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text'=>'Falha ao realizar operação'

            ]);
        }
    }
         
}
