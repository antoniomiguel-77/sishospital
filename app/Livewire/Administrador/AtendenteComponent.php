<?php

namespace App\Livewire\Administrador;

use App\Models\Atendente;
use App\Models\Municipio;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AtendenteComponent extends Component
{
    use LivewireAlert;
    public $estado,$atendenteId,$pesquisar,$mostrar = 5,$nomeCompleto,$dataDeNascimento,$idade,$nacionalidade,
            $contribuente,$provincia,$municipio,$departamento_id,$documentosAssociados,
            $telefone, $genero,$email,$todosMunicipios = [];
   
    protected $listeners = ['excluir'=>'excluir','fecharModal'=>'fecharModal'];
    public function render()
    {
        return view('livewire.administrador.atendente-component',[
            'atendentes'=>$this->listar($this->pesquisar),
            'provincias'=>$this->pegarProvincias(),
            'nacionalidades'=>$this->pegarPais(),

        ])->layout('layouts.administrador.app');;
    }

    protected $mensagens = [
        'especialidade_id.required'=>'Obrigatório',
        'departamento_id.required'=>'Obrigatório',
        'nomeCompleto.required'=>'Obrigatório',
        'dataDeNascimento.required'=>'Obrigatório',
        'nacionalidade.required'=>'Obrigatório',
        'contribuente.required'=>'Obrigatório',
        'provincia.required'=>'Obrigatório',
        'municipio.required'=>'Obrigatório',
        'endereco.required'=>'Obrigatório',
        'telefone.required'=>'Obrigatório',
        'genero.required'=>'Obrigatório',
        'email.unique'=>'Já existe',
        'email.required'=>'Obrigatório',
    ];
  
 

    public function filtrarMunicipioPorProvincia()
    {
        try {

            if($this->provincia != null)
            {
              $this->todosMunicipios =   Municipio::where('provincia_id',$this->provincia)->get();
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

    public function pegarProvincias()
    {
        try {
          
            return Provincia::orderBy('descricao','asc')->get();
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
    
    public function pegarPais()
    {
        try {
           
            return Pais::orderBy('descricao','asc')->get();
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }
 

    public function listar($pesquisar = null)
    {
        try {

            if($pesquisar != null)
            {
              return  Atendente::where('nomeCompleto','like','%'.$pesquisar.'%')
                ->orderBy('nomeCompleto','asc')
                ->limit($this->mostrar)
                ->get();
            }else{
                
               return Atendente::orderBy('nomeCompleto','desc')
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

    public function salvar()
    {
        
        DB::beginTransaction();
        $this->validate([
            'nomeCompleto'=>'required',
            'dataDeNascimento'=>'required',
            'nacionalidade'=>'required',
            'contribuente'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'telefone'=>'required',
            'genero'=>'required',
            'email'=>'required|unique:users,email,'.$this->atendenteId,
        ],$this->mensagens);
        try {
     
                $usuario = User::create([
                    'name'=>$this->nomeCompleto,
                    'email'=>$this->email,
                    'password'=>Hash::make('123456789'),
                    'nivel'=>'Atendente',
                    'estado'=>'Activa',
                ]);
                
                Atendente::create([
                    'user_id'=>$usuario->id,
                    'nomeCompleto'=>$this->nomeCompleto,
                    'dataDeNascimento'=>$this->dataDeNascimento,
                    'idade'=>Carbon::parse($this->dataDeNascimento)->age,
                    'nacionalidade'=>$this->nacionalidade,
                    'contribuente'=>$this->contribuente,
                    'provincia'=>Provincia::find($this->provincia)->descricao,
                    'municipio'=>$this->municipio,
                    'telefone'=>$this->telefone,
                    'genero'=>$this->genero,
                    'email'=>$this->email,
                    'estado'=>$this->estado ?? 'Activo',

                ]);
       
                $this->alert('success', 'SUCESSO', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text'=>'Operação Realizada com sucesso'
                ]);
            
            $this->limparCampos();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
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

            $atendente =   Atendente::find($id);
            $provincia = Provincia::where('descricao','=',$atendente->provincia)->first();
            $municipio = Municipio::where('provincia_id',$provincia->id)->first();
            
            $this->nomeCompleto = $atendente->nomeCompleto;
            $this->dataDeNascimento = $atendente->dataDeNascimento;
            $this->nacionalidade = $atendente->nacionalidade;
            $this->contribuente = $atendente->contribuente;
            $this->provincia =  $provincia->id;
            $this->municipio = $municipio->descricao;
            $this->telefone = $atendente->telefone;
            $this->genero = $atendente->genero;
            $this->atendenteId =   $atendente->id;
            $this->email =   $atendente->email;
            $this->estado =   $atendente->estado;
   
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
        $this->validate([
            'nomeCompleto'=>'required',
            'nomeCompleto'=>'required',
            'dataDeNascimento'=>'required',
            'nacionalidade'=>'required',
            'contribuente'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'telefone'=>'required',
            'genero'=>'required',
            'email'=>'required|unique:atendentes,email,'.$this->atendenteId,
            ],$this->mensagens);
        try {
           

         
        
            
                
              $atendente =   Atendente::find($this->atendenteId);
              
              
              $atendente->update([
                    'nomeCompleto'=>$this->nomeCompleto,
                    'dataDeNascimento'=>$this->dataDeNascimento,
                    'idade'=>Carbon::parse($this->dataDeNascimento)->age,
                    'nacionalidade'=>$this->nacionalidade,
                    'contribuente'=>$this->contribuente,
                    'provincia'=>Provincia::find($this->provincia)->descricao,
                    'municipio'=>$this->municipio,
                    'telefone'=>$this->telefone,
                    'genero'=>$this->genero,
                    'email'=>$this->email,
                    'estado'=>$this->estado ?? 'Activo',
                    'documentosAssociados'=>$this->documentosAssociados ?? $atendente->documentosAssociados,
                  
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
            $this->atendenteId = $id;
            $this->alert('question', 'TEM A CERTEZA', [
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
           Atendente::destroy($this->atendenteId);
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
            $this->nomeCompleto = '';
            $this->dataDeNascimento = '';
            $this->nacionalidade = '';
            $this->contribuente = '';
            $this->provincia = '';
            $this->municipio = '';
            $this->telefone = '';
            $this->genero = '';
            $this->atendenteId =   '';
            $this->email =   '';
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
