<?php

namespace App\Livewire\Medico;

use App\Models\RegistroDeAlta;
use App\Models\Triagem;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ListaRegistroDeAlta extends Component
{
    use LivewireAlert;
    public $paciente, $mostrar = 5,$triagem,$startdate = null,$enddate = null;

    //Propiedades para editar o registro de Alta
   public $registro_id,$diagnosticoDeEntrada,$estadoDeSaude,$condicaoDeSaudo,$recomendacao,$orientacao,$diagnosticoDeSaida;

    public function render()
    {
        return view('livewire.medico.lista-registro-de-alta',[
            'dados'=>$this->pegarRegistroDeAlta($this->triagem,$this->startdate,$this->enddate),
            'triagens'=>$this->pegarTriangens()
        ])->layout('layouts.medico.app');
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


    public function pegarRegistroDeAlta($triagem,$startdate,$enddate)
    {
        try {
            
            if ($triagem != null and $startdate == null  and $enddate == null) {

                return RegistroDeAlta::orderBy('id','desc')
                ->where('medico_id',auth()->user()->medico->id)
                ->where('triagem_id',$triagem)
                ->limit($this->mostrar)
                ->get();

            }elseif($triagem != null and $startdate != null  and $enddate != null){
           
                $start = Carbon::parse($startdate)->format('Y-m-d').' 00:00:00';
                $end = Carbon::parse($enddate)->format('Y-m-d').' 23:59:59';
                
                return RegistroDeAlta::orderBy('id','desc')
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

    // Metodo para editar o registro de Alta
    public function editar($id)
    {
        try {
            $registroDeAlta = RegistroDeAlta::find($id);
            $this->registro_id = $registroDeAlta->id;
            $this->diagnosticoDeEntrada = $registroDeAlta->diagnosticoDeEntrada;
            $this->estadoDeSaude = $registroDeAlta->estado;
            $this->condicaoDeSaudo = $registroDeAlta->condicaoDeSaude;
            $this->recomendacao = $registroDeAlta->recomendacao;
            $this->orientacao = $registroDeAlta->orientacao;
            $this->diagnosticoDeSaida = $registroDeAlta->diagnosticoDeSaida;
            $this->paciente = $registroDeAlta->triagens->paciente->nomeCompleto;

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

    // Metodo para actualiar registro de Alta
    public function actualizar()
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
    
                RegistroDeAlta::find($this->registro_id)->update([
                    'condicaoDeSaude'=>$this->condicaoDeSaudo,
                    'recomendacao'=>$this->recomendacao,
                    'orientacao'=>$this->orientacao,
                    'diagnosticoDeEntrada'=>$this->diagnosticoDeEntrada,
                    'diagnosticoDeSaida'=>$this->diagnosticoDeSaida,
                    'estado'=>$this->estadoDeSaude,
                ]);
    
    
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
