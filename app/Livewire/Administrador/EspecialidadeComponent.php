<?php

namespace App\Livewire\Administrador;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Especialidade;
use Exception;

class EspecialidadeComponent extends Component
{

    use LivewireAlert;
    public $descricao ,$especialidadeId,$pesquisar,$mostrar = 10;
    protected $listeners = ['excluir'=>'excluir','fecharModal'=>'fecharModal'];

     public $inputs,$i;
     public function mount(){
        
        $this->inputs = [];
        $this->descricao = [];
        $this->i = 1;
     }

    public function remove($key){
      unset($this->inputs[$key]);
    }

    public function add($i){
       $this->i = $i + 1;
       array_push($this->inputs,$i);
    }


    public function render()
    {
        return view('livewire.administrador.especialidade-component',[
            'especialidades'=>$this->listar($this->pesquisar,$this->mostrar)
        ])->layout('layouts.administrador.app');
    }

  

 

    public function listar($pesquisar = null,$mostrar)
    {
        try {

            if($pesquisar != null)
            {
              return  Especialidade::where('descricao','like','%'.$pesquisar.'%')
                ->orderBy('descricao','desc')
                ->limit($mostrar)
                ->get();
            }else{

                
               return Especialidade::orderBy('descricao','desc')
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
      
          $this->validate(
              ['descricao.0'=>'required|unique:especialidades,descricao','descricao.*'=>'required|unique:especialidades,descricao'],
              ['descricao.0.required'=>'Obrigatório','descricao.0.unique'=>'Já Existe','descricao.*.required'=>'Obrigatório','descricao.*.unique'=>'Já existe']
          );

        try {
           
            
                foreach ($this->inputs as $key => $input) {
                  
                       
                        Especialidade::create(['descricao'=>$this->descricao[$key]]);
                    
                 }
           
       
                $this->alert('success', 'SUCESSO', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text'=>'Operação Realizada com sucesso'
                ]);
             
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
    public function editar($id)
    {
        try {

            $especialidade =   Especialidade::find($id);
            $this->descricao =   $especialidade->descricao;
            $this->especialidadeId =   $especialidade->id;
   
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
    public function actualizar()
    {
        $this->validate(['descricao'=>'required|unique:especialidades,descricao,'.$this->especialidadeId],['descricao.required'=>'Obrigatório','descricao.unique'=>'Já Existe']);
        try {
        
                
                Especialidade::find($this->especialidadeId)->update([
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
            $this->especialidadeId = $id;
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
           Especialidade::destroy($this->especialidadeId);
           $this->alert('success', 'SUCESSO', [
            'position' => 'center',
            'toast' => false,
            'timer' => 2000,
            'text'=>'Operação Realizada com sucesso'
        ]);
        }catch(Exception $ex){
            dd($th->getMessage());

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
            $this->descricao = [];
            $this->especialidadeId = '';
           $this->inputs = [];
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
