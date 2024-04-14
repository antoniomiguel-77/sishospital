<?php

namespace App\Livewire\Medico;

use App\Models\DiarioClinico;
use App\Models\Triagem;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ListarDiarioClinico extends Component
{
    use LivewireAlert;
    public $paciente, $mostrar = 5,$triagem,$startdate = null,$enddate = null;
    //propriedades de edição de diario clinico
    public $diario_id,$descricaoDiarioClinico;
    //eventos
    protected $listeners = ['fecharModal'=>'fecharModal'];
    public function render()
    {
        return view('livewire.medico.listar-diario-clinico',[
            'dados'=>$this->pegarDiariosClinicos($this->triagem,$this->startdate,$this->enddate),
            'triagens'=>$this->pegarTriangens()
        ])->layout('layouts.medico.app');
    }

    public function pegarDiariosClinicos($triagem,$startdate,$enddate)
    {
        try {
            
            if ($triagem != null and $startdate == null  and $enddate == null) {

                return DiarioClinico::orderBy('id','desc')
                ->where('medico_id',auth()->user()->medico->id)
                ->where('triagem_id',$triagem)
                ->limit($this->mostrar)
                ->get();

            }elseif($triagem != null and $startdate != null  and $enddate != null){
           
                $start = Carbon::parse($startdate)->format('Y-m-d').' 00:00:00';
                $end = Carbon::parse($enddate)->format('Y-m-d').' 23:59:59';
                
                return DiarioClinico::orderBy('id','desc')
                ->where('medico_id',auth()->user()->medico->id)
                ->where('triagem_id',$triagem)
                ->whereBetween('created_at',[$start,$end])
                ->limit($this->mostrar)
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


    public function editar($id)
    {
        try {
            $diarioClinico = DiarioClinico::find($id);
            $this->diario_id = $diarioClinico->id;
            $this->descricaoDiarioClinico = $diarioClinico->descricao;
            $this->paciente = $diarioClinico->triagem->paciente->nomeCompleto;

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

    //Actualizar diario clinico
    public function update()
    {
        $this->validate(['descricaoDiarioClinico'=>'required','descricaoDiarioClinico.required'=>'Obrigatório']);
        try {
          
            DiarioClinico::find($this->diario_id)->update([
                'descricao'=>$this->descricaoDiarioClinico,
            ]);
            
            $this->descricaoDiarioClinico = '';
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
}
