<?php

namespace App\Livewire\Medico;

use App\Models\Medico;
use App\Models\{DiarioClinico, Exame, Laboratorio, Triagem, ObservacaoMedica as ModelObservacaoMedica, PedidoDeExame, RegistroDeAlta};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class AguardandoDecisaoMedica extends Component
{
    use LivewireAlert;
    

   public $pesquisar,$mostrar,$pedidoExameId,
   $queixasPrincipais,$assistenciaPreHospitalar,
   $diagnosticoDeEntrada,$dataObservacao,
   $horaObservacao,$observacaoSumaria,$triagem_id,$paciente;

    //Propiedades para cadastro de diario Clinico do paciente
   public $descricaoDiarioClinico;

    //Propiedades para cadastro de alta do paciente
   public $estadoDeSaude,$condicaoDeSaudo,$recomendacao,$orientacao,$diagnosticoDeSaida;


  

   public $laboratorio,$exames  = [],$descricao;
   //Eventos
    protected $listeners = ['fecharModal'=>'fecharModal','fecharTodasModals'=>'fecharTodasModals'];

    public function render()
    {
        return view('livewire.medico.aguardando-decisao-medica',[
            'decisoesPendentes'=>$this->listarPacientesAguardandoDecisao($this->pesquisar,$this->mostrar),
            'laboratorios'=>$this->pegarTodosLaboratorios(),
            'todosExames'=>$this->pegarTodosExames()
        ])->layout('layouts.medico.app');
    }

    public function pegarTodosExames()
    {
        try {
           return Exame::get();
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
    public function pegarTodosLaboratorios()
    {
        try {
           return Laboratorio::get();
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
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

    public function pegarIdDaTriagem($id)
    {
        try {
           $this->triagem_id = $id;
          $this->paciente = Triagem::find($id)->paciente->nomeCompleto ?? 'N/D';
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }

    //Registrar pedido de exame
    public function registrarPedidoDeExame()
    {
         
          $this->validate([
              'laboratorio'=>'required',
              'exames'=>'required',
          ],[
              'laboratorio.required'=>'Obrigatório',
              'exames.required'=>'Obrigatório',
          ]);
      
         try {
         
            $medico = Medico::where('user_id',auth()->user()->medico->user_id)
            ->select('id')
            ->first();
             
            PedidoDeExame::create([
                'triagem_id'=>$this->triagem_id,
                'medico_id'=>$medico->id,
                'laboratorio'=>$this->laboratorio,
                'exames'=>$this->exames,
                'descricao'=>$this->descricao,
            ]);

            $this->alert('success', 'SUCESSO', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text'=>'Operação Realizada com sucesso'
            ]);

            $this->dispatch('fecharModal');
            

         } catch (\Throwable $th) {
             $this->alert('error', 'FALHA', [
                 'position' => 'center',
                 'toast' => false,
                 'timer' => 2000,
                 'text' => 'Falha ao realizar operação',
             ]);
         }
    }

    // METODO PARA REGISTRAR PACIENTE AGUARDANDO DECISÃO MÉDICA
    public function registrarDiarioClinico()
    {
      
        $this->validate(['descricaoDiarioClinico'=>'required'],['descricaoDiarioClinico.required'=>'Obrigatório']);
        try {
          

            DiarioClinico::create([
                'descricao'=>$this->descricaoDiarioClinico,
                'medico_id'=>auth()->user()->medico->id,
                'triagem_id'=>$this->triagem_id
            ]);
            
            $this->descricaoDiarioClinico = '';
            $this->triagem_id  = '';
            $this->paciente = '';
            $this->dispatch('fecharModal');
            $this->alert('success', 'Operação realizada com sucesso!!');

           
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

    // Metodo para registrar alto do paciente
    public function registrarAltaDoPaciente()
    {
        $this->validate([
            'estadoDeSaude'=>'required',
            'condicaoDeSaudo'=>'required',
            'recomendacao'=>'required',
            'orientacao'=>'required',
            'diagnosticoDeEntrada'=>'required',
            'diagnosticoDeSaida'=>'required',
        ],[
            'estadoDeSaude.required'=>'Obrigatório',
            'condicaoDeSaudo.required'=>'Obrigatório',
            'recomendacao.required'=>'Obrigatório',
            'orientacao.required'=>'Obrigatório',
            'diagnosticoDeEntrada.required'=>'Obrigatório',
            'diagnosticoDeSaida.required'=>'Obrigatório', 
        ]);
        try {

            RegistroDeAlta::create([
                'triagem_id'=>$this->triagem_id,
                'medico_id'=>auth()->user()->medico->id,
                'condicaoDeSaude'=>$this->condicaoDeSaudo,
                'recomendacao'=>$this->recomendacao,
                'orientacao'=>$this->orientacao,
                'diagnosticoDeEntrada'=>$this->diagnosticoDeEntrada,
                'diagnosticoDeSaida'=>$this->diagnosticoDeSaida,
                'estado'=>$this->estadoDeSaude,
            ]);


                $this->triagem_id = '';
                $this->condicaoDeSaudo = '';
                $this->recomendacao = '';
                $this->orientacao = '';
                $this->diagnosticoDeEntrada = '';
                $this->diagnosticoDeSaida = '';
                $this->estadoDeSaude = '';
                $this->alert('success', 'Operação realizada com sucesso!!');
                $this->dispatch('fecharModal');
            
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
