<?php

namespace App\Livewire\Medico;

use App\Models\Exame;
use App\Models\Laboratorio;
use App\Models\PedidoDeExame;
use App\Models\Triagem;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ListarExame extends Component
{
    use LivewireAlert;
    public $paciente, $mostrar = 5,$triagem,$estado = 0,$startdate,$enddate;
    //propriedade para editar exames
    public $laboratorio,$pedidoExameId,$exames  = [],$descricao;
    //Eventos
    protected $listeners = ['fecharModal'=>'fecharModal','marcarComoRealizada'=>'marcarComoRealizada'];
    public function render()
    {
        return view('livewire.medico.listar-exame',[
            'dados'=>$this->pegarListaDeExames($this->triagem,$this->startdate,$this->enddate),
            'triagens'=>$this->pegarTriangens(),
            'todosExames'=>$this->pegarTodosExames(),
            'laboratorios'=>$this->pegarTodosLaboratorios()
        ])->layout('layouts.medico.app');
    }
//listar todos exames do sistema
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
    // Pegar todos os laboratórios cadastrados no sistema
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
    public function pegarListaDeExames($triagem,$startdate,$enddate)
    {
        try {
            if ($triagem != null and $startdate == null and $enddate == null) {
              
                return PedidoDeExame::orderBy('id','desc')
                ->where('medico_id',auth()->user()->medico->id)
                ->where('triagem_id',$triagem)
                ->where('estado',$this->estado)
                ->limit($this->mostrar)
                ->get();

            }else if($triagem != null and $startdate != null and $enddate != null)
            {
                $start = Carbon::parse($startdate)->format('Y-m-d').' 00:00:00';
                $end = Carbon::parse($enddate)->format('Y-m-d').' 23:59:59';
                

                return PedidoDeExame::orderBy('id','desc')
                ->where('medico_id',auth()->user()->medico->id)
                ->where('triagem_id',$triagem)
                ->where('estado',$this->estado)
                ->whereBetween('created_at',[$start,$end])
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

    //mETODO PARA EDITAR PEDIDO DE EXAME
    public function editar($id)
    {
        try {
          $pedidosDeExame =  PedidoDeExame::find($id);
          $this->laboratorio = $pedidosDeExame->laboratorio;
          $this->exames = $pedidosDeExame->exames;
          $this->descricao = $pedidosDeExame->descricao;
          $this->pedidoExameId = $pedidosDeExame->id;
          $this->paciente = $pedidosDeExame->triagens->paciente->nomeCompleto ;
        
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
    //Metodo para actualizar pedido de exame
    public function actualizar()
    {
        try {
          PedidoDeExame::find($this->pedidoExameId)->update([
            'laboratorio'=>$this->laboratorio,
            'exames'=>$this->exames,
            'descricao'=>$this->descricao,
          ]);
          $this->laboratorio = '';
          $this->exames = '';
          $this->descricao = '';
          $this->pedidoExameId = '';
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

    // Metodo para confirmar marcacao de exame como realizada
    public function confirmar($id)
    {
        try {
            $this->pedidoExameId = $id;
            $this->alert('question', 'TEM A CERTEZA', [
                'icon' => 'warning',
                'position' => 'top-end',
                'toast' => true,
                'timer' => null,
                'text' => 'Deseja Realmente marcar esse exame como realizado?',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Não',
                'confirmButtonText' => 'Sim',
                'confirmButtonColor' => '#2CA33E',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'marcarComoRealizada' 
            ]);
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

    public function marcarComoRealizada()
    {
        try {

           $exame = PedidoDeExame::find($this->pedidoExameId);
           $exame->estado = 1;
           $exame->save();


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
}
