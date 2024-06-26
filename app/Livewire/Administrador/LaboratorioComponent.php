<?php

namespace App\Livewire\Administrador;

use App\Models\Laboratorio;
use Exception;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class LaboratorioComponent extends Component
{
    use LivewireAlert;
    public $descricao,$imagem,$exameId,$pesquisar,$mostrar = 5,$telefone;
    protected $listeners = ['excluir'=>'excluir','fecharModal'=>'fecharModal'];

    public function render()
    {
        return view('livewire.administrador.laboratorio-component',[
            'laboratorios'=>$this->listar($this->pesquisar,$this->mostrar),
        ])->layout('layouts.administrador.app');
    }

    public function listar($pesquisar = null,$mostrar)
    {
        try {

            if($pesquisar != null)
            {
              return  Laboratorio::where('descricao','like','%'.$pesquisar.'%')
                ->orderBy('descricao','desc')
                ->limit($mostrar)
                ->get();
            }else{

               return Laboratorio::orderBy('descricao','desc')
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

    public function salvar()
    {
        $this->validate(['descricao'=>'required|unique:departamentos,descricao'],['descricao.required'=>'Obrigatório']);
        try {
           
          
                Laboratorio::create([
                    'descricao'=>$this->descricao,
                ]);
       
                $this->alert('success', 'SUCESSO', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text'=>'Operação Realizada com sucesso'
                ]);
        
            $this->limparCampos();
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

            $lab =   Laboratorio::find($id);
            $this->descricao =   $lab->descricao;
            $this->labId =   $lab->id;
   
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
    public function actualizar()
    {
        
        try {
            $this->validate(['descricao'=>'required|unique:departamentos,descricao,'.$this->exameId],
            ['descricao.required'=>'Obrigatório','descricao.unique'=>'Já Existe']);
            
                
                Laboratorio::find($this->labId)->update([
                    'descricao'=>$this->descricao,
                ]);
       
                $this->alert('success', 'SUCESSO', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text'=>'Operação Realizada com sucesso'
                ]);
         
            $this->dispatch('fecharModal');
            $this->limparCampos();

        } catch (\Throwable $th) {
         ~
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
    public function confirmarExclusao($id){
        try{
            $this->labId = $id;
            $this->alert('question', 'AVISO', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'text' => 'Deseja Realmente Excluir Este Registro? Não pode reverter está ação.',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Excluir',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'excluir' 
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

    public function excluir(){
        try{
           Laboratorio::destroy($this->labId);
           $this->alert('success', 'SUCESSO', [
            'position' => 'center',
            'toast' => false,
            'timer' => 2000,
            'text'=>'Operação Realizada com sucesso'
        ]);
        }catch(Exception $ex){
            $this->alert('error', 'ERRO', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text'=>'Falha ao realizar operação'

            ]);
        }
    }

    public function limparCampos()
    {
        try {
            $this->descricao = '';
            $this->labId = '';
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
