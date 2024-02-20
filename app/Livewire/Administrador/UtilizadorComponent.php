<?php

namespace App\Livewire\Administrador;

use App\Models\User;
use Exception;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UtilizadorComponent extends Component
{
    use LivewireAlert;
    public $utilizadorId,$pesquisar,$mostrar = 10;
    protected $listeners = ['desativarConta'=>'desativarConta'];
    public function render()
    {
        return view('livewire.administrador.utilizador-component',[
            'utilizadores'=>$this->listar($this->pesquisar,$this->mostrar)
        ])->layout('layouts.administrador.app');
    }

    public function listar($pesquisar = null,$mostrar)
    {
        try {

            if($pesquisar != null)
            {
              return  User::where('name','like','%'.$pesquisar.'%')
                ->orderBy('name','desc')
                ->limit($mostrar)
                ->get();
            }else{

               return User::orderBy('name','desc')
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

    public function confirmarMudancaDeEstado($id){
        try{
            $this->utilizadorId = $id;
            $this->alert('question', 'TEM A CERTEZA', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'text' => 'Deseja Realmente Mudar o estado desta conta?',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Cancelar',
                'confirmButtonText' => 'Mudar',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'desativarConta' 
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
    public function desativarConta()
    {
    
        try {
          
            $utilizador = User::find($this->utilizadorId);
            $utilizador->estado = ($utilizador->estado == 'Activa')? 'Inactiva':'Activa';
            $utilizador->save();

            $this->alert('success', 'SUCESSO', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text'=>'Operação Realizada com sucesso'
            ]);

            $this->utilizadorId = '';

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
