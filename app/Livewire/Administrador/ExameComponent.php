<?php

namespace App\Livewire\Administrador;

use App\Models\Exame;
use Exception;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ExameComponent extends Component
{
    use LivewireAlert;
    public $descricao,$imagem,$exameId,$pesquisar,$mostrar = 5,$telefone;
    protected $listeners = ['excluir'=>'excluir','fecharModal'=>'fecharModal'];

    public function render()
    {
        return view('livewire.administrador.exame-component',[
            'exames'=>$this->listar($this->pesquisar,$this->mostrar),
        ])->layout('layouts.administrador.app');
    }

    public function listar($pesquisar = null,$mostrar)
    {
        try {

            if($pesquisar != null)
            {
              return  Exame::where('descricao','like','%'.$pesquisar.'%')
                ->orderBy('descricao','desc')
                ->limit($mostrar)
                ->get();
            }else{

               return Exame::orderBy('descricao','desc')
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
        $this->validate(['descricao'=>'required|unique:exames,descricao'],['descricao.required'=>'Obrigatório']);
        try {
           
          
                Exame::create([
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

            $exame =   Exame::find($id);
            $this->descricao =   $exame->descricao;
            $this->exameId =   $exame->id;
   
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
            
                
                Exame::find($this->exameId)->update([
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
            $this->exameId = $id;
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
           Exame::destroy($this->exameId);
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
            $this->exameId = '';
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
