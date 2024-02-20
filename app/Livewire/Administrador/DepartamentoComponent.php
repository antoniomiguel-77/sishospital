<?php

namespace App\Livewire\Administrador;

use App\Models\Departamento;
use Exception;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class DepartamentoComponent extends Component
{
    use LivewireAlert;
    public $descricao,$imagem,$departamentoId,$pesquisar,$mostrar = 5,$telefone;
    protected $listeners = ['excluir'=>'excluir','fecharModal'=>'fecharModal'];
    public function render()
    {
        return view('livewire.administrador.departamento-component',[
            'departamentos'=>$this->listar($this->pesquisar,$this->mostrar),
        ])->layout('layouts.administrador.app');
    }

    public function listar($pesquisar = null,$mostrar)
    {
        try {

            if($pesquisar != null)
            {
              return  Departamento::where('descricao','like','%'.$pesquisar.'%')
                ->orderBy('descricao','desc')
                ->limit($mostrar)
                ->get();
            }else{

               return Departamento::orderBy('descricao','desc')
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

    public function salvar()
    {
        $this->validate(['descricao'=>'required|unique:departamentos,descricao','telefone'=>'required|unique:departamentos,telefone'],['descricao.required'=>'Obrigatório','descricao.unique'=>'Já Existe','telefone.required'=>'Obrigatório','telefone.unique'=>'Já Existe']);
        try {
           
          
                Departamento::create([
                    'descricao'=>$this->descricao,
                    'telefone'=>$this->telefone,
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

            $departamento =   Departamento::find($id);
            $this->descricao =   $departamento->descricao;
            $this->telefone =   $departamento->telefone;
            $this->departamentoId =   $departamento->id;
   
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
            $this->validate(['descricao'=>'required|unique:departamentos,descricao,'.$this->departamentoId,'telefone'=>'required|unique:departamentos,telefone,'.$this->departamentoId],
            ['descricao.required'=>'Obrigatório','descricao.unique'=>'Já Existe','telefone.required'=>'Obrigatório','telefone.unique'=>'Já Existe']);
            
                
                Departamento::find($this->departamentoId)->update([
                    'descricao'=>$this->descricao,
                    'telefone'=>$this->telefone,
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
            dd($th->getMessage());
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
            $this->departamentoId = $id;
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
           Departamento::destroy($this->departamentoId);
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
            $this->telefone = '';
            $this->departamentoId = '';
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
