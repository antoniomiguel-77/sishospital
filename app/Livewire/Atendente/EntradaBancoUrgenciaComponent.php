<?php

namespace App\Livewire\Atendente;

use App\Models\AreaBancoDeUrgencia;
use App\Models\Departamento;
use App\Models\EntradaBancoDeUrgencia;
use App\Models\Paciente;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class EntradaBancoUrgenciaComponent extends Component
{
 
    use LivewireAlert;
    public $pacienteId,$pesquisar,$mostrar = 5,$acompanhante,$proveniencia,$areaDeBancoDeUrgencia,$telefone,$paciente;
    protected $listeners = ['fecharModal'=>'fecharModal','DarEntrada'=>'DarEntrada','chamarModal'=>'chamarModal'];
    public function render()
    {
        return view('livewire.atendente.entrada-banco-urgencia',[
            'pacientes'=>$this->listar($this->pesquisar,$this->mostrar),
            'areas'=>$this->areasBancoDeUrgencia()
        ])->layout('layouts.atendente.app');
    }

    public function areasBancoDeUrgencia()
    {
        try {
            return Departamento::orderBy('descricao','asc')->get();
        } catch (\Throwable $th) {
            
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
   

    public function listar($pesquisar = null, $mostrar = 10)
    {
        try {

            if($pesquisar != null and $mostrar != null)
            {
              return  EntradaBancoDeUrgencia::join('pacientes','pacientes.id','entrada_banco_de_urgencias.paciente_id')
                ->where('pacientes.nomeCompleto','like','%'.$pesquisar.'%')
                ->select('entrada_banco_de_urgencias.created_at','pacientes.nomeCompleto',
                'entrada_banco_de_urgencias.telefone','entrada_banco_de_urgencias.area','entrada_banco_de_urgencias.proveniencia',
                'entrada_banco_de_urgencias.acompanhante','entrada_banco_de_urgencias.situacao')
                ->where('entrada_banco_de_urgencias.situacao','Aguardando Triagem')
                ->whereDate('entrada_banco_de_urgencias.created_at',today())
                ->orderBy('entrada_banco_de_urgencias.id','asc')
                ->limit($mostrar)
                ->get();
            }else{

               return EntradaBancoDeUrgencia::join('pacientes','pacientes.id','entrada_banco_de_urgencias.paciente_id')
               ->select('entrada_banco_de_urgencias.created_at','pacientes.nomeCompleto',
               'entrada_banco_de_urgencias.telefone','entrada_banco_de_urgencias.area','entrada_banco_de_urgencias.proveniencia',
               'entrada_banco_de_urgencias.acompanhante','entrada_banco_de_urgencias.situacao')
               ->where('entrada_banco_de_urgencias.situacao','Aguardando Triagem')
               ->whereDate('entrada_banco_de_urgencias.created_at',today())
               ->orderBy('entrada_banco_de_urgencias.id','asc')
               ->limit($mostrar)
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
 

  
 

    public function confirmarRegistro(){
        try{
           
            $this->alert('question', 'AVISO', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'text' => 'Deseja Realmente Registrar os dados de entrada no banco de urgência desse paciente?',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Registrar',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'DarEntrada' 
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
    public function DarEntrada()
    {
        $this->validate([
            'paciente'=>'required',
            'acompanhante'=>'required',
            'proveniencia'=>'required',
            'proveniencia'=>'required',
            'telefone'=>'required',
            'areaDeBancoDeUrgencia'=>'required',
        ],[
            'paciente.required'=>'Obrigatório',
            'acompanhante.required'=>'Obrigatório',
            'proveniencia.required'=>'Obrigatório',
            'proveniencia.required'=>'Obrigatório',
            'telefone.required'=>'Obrigatório',
            'areaDeBancoDeUrgencia.required'=>'Obrigatório',
        ]);
        DB::beginTransaction();
        try {
            $existe = Paciente::where('nomeCompleto',$this->paciente)->first();
            if ($existe) {
            
                EntradaBancoDeUrgencia::create([
                    'paciente_id'=>$existe->id,
                    'acompanhante'=>$this->acompanhante,
                    'data'=>date('Y-m-d'),
                    'hora'=>date('H:i'),
                    'proveniencia'=>$this->proveniencia,
                    'area'=>$this->areaDeBancoDeUrgencia,
                    'telefone'=>$this->telefone,
                    'situacao'=>'Aguardando Triagem',
                ]);

                $this->alert('warning', 'AVISO', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text'=>'Não é a primeira vez que este paciente da entrada no banco de Urgência'
                ]);

                
            }else{

                $paciente =  Paciente::create([
                     'nomeCompleto'=>$this->paciente
                ]);
               
                 EntradaBancoDeUrgencia::create([
                     'paciente_id'=>$paciente->id,
                     'acompanhante'=>$this->acompanhante,
                     'data'=>date('Y-m-d'),
                     'hora'=>date('H:i'),
                     'proveniencia'=>$this->proveniencia,
                     'area'=>$this->areaDeBancoDeUrgencia,
                     'telefone'=>$this->telefone,
                     'situacao'=>'Aguardando Triagem',
                 ]);
                 $this->alert('success', 'SUCESSO', [
                     'position' => 'center',
                     'toast' => false,
                     'timer' => 2000,
                     'text'=>'Operação Realizada com sucesso'
                 ]);
            }



            DB::commit();
            $this->dispatch('fecharModal');
            $this->limparCampos();
        } catch (\Throwable $th) {
            
            DB::rollBack();
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
            $this->pacienteId = '';
            $this->mostrar = '';
            $this->acompanhante = '';
            $this->proveniencia = '';
            $this->areaDeBancoDeUrgencia = '';
            $this->telefone = '';
            $this->paciente = '';
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
