<?php

namespace App\Livewire\Enfermeiro;

use App\Models\Departamento;
use App\Models\EntradaBancoDeUrgencia;
use App\Models\Triagem;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class PacienteAguardandoTriagem extends Component
{
    public function render()
    {
        return view('livewire.enfermeiro.paciente-aguardando-triagem',[
            'entradas'=>$this->listarEntradas($this->pesquisar,$this->mostrar,$this->dataInicial,$this->dataFinal),
            'areasDeAtendimento'=>$this->pegarDepartamentos()
        ])->layout('layouts.enfermeiro.app');
    }

    use LivewireAlert;
    public $dataInicial,$dataFinal,$mostrar= 5,$pesquisar,$entradaId,$proveniencia;
    public $paciente,$pacienteId,$acompanhante,$telefone,
            $respiracao,$pulso,$tensaoDiastolica,$tensaoSistolica,$temperatura,$escalaDeManchester,
            $encaminharPara,$notaDeTriagem,$peso;
            protected $listeners = ['registrarTriagem'=>'registrarTriagem','fecharModal'=>'fecharModal'];


    public function pegarDepartamentos()
    {
        try {
            return Departamento::orderBy('descricao','desc')->get();
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

   

    public function listarEntradas($pesquisar,$mostrar,$dataInicial,$dataFinal)
    {
        try {
            $inicial = Carbon::parse($dataInicial)->format('Y-m-d').' 00:00:00';
            $final = Carbon::parse($dataFinal)->format('Y-m-d').' 23:59:59';

     

            if($pesquisar != null and $mostrar != null and $dataInicial != null and $dataFinal != null)
            {
              return  EntradaBancoDeUrgencia::join('pacientes','pacientes.id','=','entrada_banco_de_urgencias.paciente_id')
              ->select('entrada_banco_de_urgencias.id as entradaId','pacientes.nomeCompleto','pacientes.idade','entrada_banco_de_urgencias.data','entrada_banco_de_urgencias.hora',
              'entrada_banco_de_urgencias.proveniencia','entrada_banco_de_urgencias.acompanhante','entrada_banco_de_urgencias.telefone','entrada_banco_de_urgencias.situacao')
              ->where('pacientes.nomeCompleto','like','%'.$pesquisar.'%')
              ->where('entrada_banco_de_urgencias.situacao','=','Aguardando Triagem')
              ->limit($mostrar)
              ->get();
            }else{
               
               return EntradaBancoDeUrgencia::join('pacientes','pacientes.id','=','entrada_banco_de_urgencias.paciente_id')
               ->select('entrada_banco_de_urgencias.id as entradaId','pacientes.nomeCompleto','pacientes.idade','entrada_banco_de_urgencias.data','entrada_banco_de_urgencias.hora',
               'entrada_banco_de_urgencias.proveniencia','entrada_banco_de_urgencias.acompanhante','entrada_banco_de_urgencias.telefone','entrada_banco_de_urgencias.situacao')
               ->whereBetween('entrada_banco_de_urgencias.created_at',[$inicial,$final])
               ->where('entrada_banco_de_urgencias.situacao','=','Aguardando Triagem')
               ->orderBy('entrada_banco_de_urgencias.id','desc')
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

    public function pegarDadosDoPaciente($id)
    {
        try {

           $entrada =  EntradaBancoDeUrgencia::find($id);
           
            
           $this->paciente = $entrada->paciente->nomeCompleto;
           $this->acompanhante = $entrada->acompanhante;
           $this->telefone = $entrada->telefone;
           $this->pacienteId = $entrada->paciente_id;
           $this->entradaId = $entrada->id;
           $this->proveniencia = $entrada->proveniencia;
           $this->encaminharPara = $entrada->encaminharPara;
           
            
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

    public function confirmarRegistro(){
        try{
           
            $this->alert('question', 'TEM A CERTEZA', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'text' => 'Deseja Realmente Registrar os dados de triagem desse paciente?',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Registrar',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'registrarTriagem' 
            ]);
        }catch(Exception $ex){
            dd($ex->getMessage());
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text'=>'Falha ao realizar operação'

            ]);
        }
    }
    public function registrarTriagem()
    {
        DB::beginTransaction();
        $this->validate([
            'paciente'=>'required',
            'acompanhante'=>'required',
            'telefone'=>'required',
            'respiracao'=>'required',
            'pulso'=>'required',
            'tensaoDiastolica'=>'required',
            'tensaoSistolica'=>'required',
            'temperatura'=>'required',
            'escalaDeManchester'=>'required',
            'notaDeTriagem'=>'required',
            'peso'=>'required',
            'proveniencia'=>'required',
            'encaminharPara'=>'required',
        ],[
            'paciente.required'=>'Obrigatório',
            'acompanhante.required'=>'Obrigatório',
            'telefone.required'=>'Obrigatório',
            'respiracao.required'=>'Obrigatório',
            'pulso.required'=>'Obrigatório',
            'tensaoDiastolica.required'=>'Obrigatório',
            'tensaoSistolica.required'=>'Obrigatório',
            'temperatura.required'=>'Obrigatório',
            'escalaDeManchester.required'=>'Obrigatório',
            'notaDeTriagem.required'=>'Obrigatório',
            'peso.required'=>'Obrigatório',
            'proveniencia.required'=>'Obrigatório',
            'encaminharPara.required'=>'Obrigatório',
        ]);

        try {

               
            Triagem::create([
                'paciente_id'=>$this->pacienteId,
                'enfermeiro_id'=>auth()->user()->enfermeiro->id  ?? '1',
                'acompanhante'=>$this->acompanhante,
                'dataEntrada'=>date('Y-m-d'),
                'horaEntrada'=>date('H:i'),
                'escalaDeManchester'=>$this->escalaDeManchester,
                'respiracao'=>$this->respiracao,
                'pulso'=>$this->pulso,
                'temperatura'=>$this->temperatura,
                'peso'=>$this->peso,
                'tensaoDiastolica'=>$this->tensaoDiastolica,
                'tensaoSistolica'=>$this->tensaoSistolica,
                'notaDeTriagem'=>$this->notaDeTriagem,
                'telefone'=>$this->telefone,
                'proveniencia'=>$this->proveniencia,
                'encaminharPara'=>$this->encaminharPara,
            ]);      
            
           $entrada =  EntradaBancoDeUrgencia::find($this->entradaId);
           $entrada->situacao = 'Aguardando Atendimento';
           $entrada->save();
            
            $this->alert('success', 'SUCESSO', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text'=>'Operação Realizada com sucesso'
            ]);
            $this->dispatch('fecharModal');
            $this->limparCampos();
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
    
    public function limparCampos()
    {
        try {
            $this->paciente = '';
            $this->acompanhante = '';
            $this->telefone = '';
            $this->respiracao = '';
            $this->pulso = '';
            $this->tensaoDiastolica = '';
            $this->tensaoSistolica = '';
            $this->temperatura = '';
            $this->escalaDeManchester = '';
            $this->encaminharPara = '';
            $this->notaDeTriagem = '';
            $this->peso = '';
            $this->proveniencia = '';
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
