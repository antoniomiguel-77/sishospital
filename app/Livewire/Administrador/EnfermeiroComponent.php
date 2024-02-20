<?php

namespace App\Livewire\Administrador;

use App\Models\Departamento;
use App\Models\Enfermeiro;
use App\Models\Especialidade;
use App\Models\Municipio;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class EnfermeiroComponent extends Component
{
 

    use WithFileUploads;
    use LivewireAlert;
    public $enfermeiroId,$pesquisar,$mostrar = 5,$especialidade_id,$nomeCompleto,$dataDeNascimento,$idade,$nacionalidade,$imagem,$dataDeVinculo,
            $numeroOrdem,$contribuente,$provincia,$municipio,$departamento_id,$documentosAssociados,
            $telefone, $genero, $estado = 'Activo', $biografia,$email,$todosMunicipios = [];
   
    protected $listeners = ['excluir'=>'excluir','fecharModal'=>'fecharModal'];
    public function render()
    {
        return view('livewire.administrador.enfermeiro-component',[
            'especialidades'=>$this->especialidades(),
            'medicos'=>$this->listar($this->pesquisar,$this->mostrar),
            'nacionalidades'=>$this->pegarPais(),
            'provincias'=>$this->pegarProvincias(),
            'departamentos'=>$this->pegarDepartamento(),
        ])->layout('layouts.administrador.app');
    }
    protected $mensagens = [
        'especialidade_id.required'=>'Obrigatório',
        'departamento_id.required'=>'Obrigatório',
        'nomeCompleto.required'=>'Obrigatório',
        'nomeCompleto.unique'=>'Já existe',
        'dataDeNascimento.required'=>'Obrigatório',
        'dataDeVinculo.required'=>'Obrigatório',
        'nacionalidade.required'=>'Obrigatório',
        'numeroOrdem.required'=>'Obrigatório',
        'contribuente.required'=>'Obrigatório',
        'provincia.required'=>'Obrigatório',
        'municipio.required'=>'Obrigatório',
        'endereco.required'=>'Obrigatório',
        'telefone.required'=>'Obrigatório',
        'genero.required'=>'Obrigatório',
        'biografia.required'=>'Obrigatório',
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
    public function pegarDepartamento()
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
    public function especialidades()
    {
        try {
           return Especialidade::orderBy('descricao','asc')->get();
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
              return  Enfermeiro::where('nomeCompleto','like','%'.$pesquisar.'%')
                ->orderBy('nomeCompleto','asc')
                ->get();
            }else{

               return Enfermeiro::orderBy('nomeCompleto','desc')
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
        
        DB::beginTransaction();
        $this->validate([
            'especialidade_id'=>'required',
            'departamento_id'=>'required',
            'nomeCompleto'=>'required',
            'nomeCompleto'=>'required',
            'dataDeNascimento'=>'required',
            'dataDeVinculo'=>'required',
            'nacionalidade'=>'required',
            'numeroOrdem'=>'required',
            'contribuente'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'telefone'=>'required',
            'genero'=>'required',
            'biografia'=>'required',
            'email'=>'required',
        ],$this->mensagens);
        try {
     
            if($this->imagem != "" && !is_string($this->imagem)){

                $extensao = $this->imagem->getclientOriginalExtension();
                $nomeDaImagem = md5($this->imagem->getclientOriginalName()).'.'. $extensao;
                $this->imagem->storeAs('/public/Medico/',$nomeDaImagem);
                $this->imagem = $nomeDaImagem;
            }

            if($this->documentosAssociados != "" && !is_string($this->documentosAssociados)){

                $extensao = $this->documentosAssociados->getclientOriginalExtension();
                $nomeDoDocumento = md5($this->documentosAssociados->getclientOriginalName()).'.'. $extensao;
                $this->documentosAssociados->storeAs('/public/Medico/',$nomeDoDocumento);
                $this->documentosAssociados = $nomeDoDocumento;
            }
                
                
             
            
                $usuario = User::create([
                    'name'=>$this->nomeCompleto,
                    'email'=>$this->email,
                    'password'=>Hash::make('123456789'),
                    'nivel'=>'Enfermeiro',
                    'estado'=>'Activa',
                ]);
                
                Enfermeiro::create([
                    'user_id'=>$usuario->id,
                    'especialidade_id'=>$this->especialidade_id,
                    'departamento_id'=>$this->departamento_id,
                    'nomeCompleto'=>$this->nomeCompleto,
                    'dataDeNascimento'=>$this->dataDeNascimento,
                    'dataDeVinculo'=>$this->dataDeVinculo,
                    'idade'=>Carbon::parse($this->dataDeNascimento)->age,
                    'nacionalidade'=>$this->nacionalidade,
                    'numeroOrdem'=>$this->numeroOrdem,
                    'contribuente'=>$this->contribuente,
                    'provincia'=>Provincia::find($this->provincia)->descricao,
                    'municipio'=>$this->municipio,
                    'telefone'=>$this->telefone,
                    'genero'=>$this->genero,
                    'estado'=>$this->estado ?? 'Activo',
                    'biografia'=>$this->biografia,
                    'email'=>$this->email,
                    'imagem'=>$this->imagem,
                    'documentosAssociados'=>$this->documentosAssociados,
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
            dd($th->getMessage());
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

            $enfermeiro =   Enfermeiro::find($id);
            $provincia = Provincia::where('descricao','=',$enfermeiro->provincia)->first();
            $municipio = Municipio::where('provincia_id',$provincia->id)->first();
            
            $this->especialidade_id = $enfermeiro->especialidade_id;
            $this->nomeCompleto = $enfermeiro->nomeCompleto;
            $this->dataDeNascimento = $enfermeiro->dataDeNascimento;
            $this->nacionalidade = $enfermeiro->nacionalidade;
            $this->imagem = $enfermeiro->imagem;
            $this->contribuente = $enfermeiro->contribuente;
            $this->provincia =  $provincia->id;
            $this->municipio = $municipio->descricao;
            $this->telefone = $enfermeiro->telefone;
            $this->genero = $enfermeiro->genero;
            $this->estado = $enfermeiro->estado;
            $this->biografia = $enfermeiro->biografia;
            $this->enfermeiroId =   $enfermeiro->id;
            $this->email =   $enfermeiro->email;
            $this->departamento_id =   $enfermeiro->departamento_id;
            $this->dataDeVinculo =   $enfermeiro->dataDeVinculo;
            $this->numeroOrdem =   $enfermeiro->numeroOrdem;
   
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
            'nomeCompleto'=>'required|unique:medicos,nomeCompleto,'.$this->enfermeiroId,
            'especialidade_id'=>'required',
            'departamento_id'=>'required',
            'nomeCompleto'=>'required',
            'nomeCompleto'=>'required',
            'dataDeNascimento'=>'required',
            'dataDeVinculo'=>'required',
            'nacionalidade'=>'required',
            'numeroOrdem'=>'required',
            'contribuente'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'telefone'=>'required',
            'genero'=>'required',
            'biografia'=>'required',
            'email'=>'required|unique:medicos,email,'.$this->enfermeiroId,
            ],$this->mensagens);
        try {
           

            if($this->imagem != "" && !is_string($this->imagem)){

                $extensao = $this->imagem->getclientOriginalExtension();
                $nomeDaImagem = md5($this->imagem->getclientOriginalName()).'.'. $extensao;
                $this->imagem->storeAs('/public/Enfermeiro/',$nomeDaImagem);
                $this->imagem = $nomeDaImagem;
            }

            if($this->documentosAssociados != "" && !is_string($this->documentosAssociados)){

                $extensao = $this->documentosAssociados->getclientOriginalExtension();
                $nomeDaDocumento = md5($this->documentosAssociados->getclientOriginalName()).'.'. $extensao;
                $this->documentosAssociados->storeAs('/public/Enfermeiro/',$nomeDaDocumento);
                $this->documentosAssociados = $nomeDaDocumento;

                
            }
             
            
                
              $enfermeiro =   Enfermeiro::find($this->enfermeiroId);
              
              
              $enfermeiro->update([
                    'especialidade_id'=>$this->especialidade_id,
                    'departamento_id'=>$this->departamento_id,
                    'nomeCompleto'=>$this->nomeCompleto,
                    'dataDeNascimento'=>$this->dataDeNascimento,
                    'dataDeVinculo'=>$this->dataDeVinculo,
                    'idade'=>Carbon::parse($this->dataDeNascimento)->age,
                    'nacionalidade'=>$this->nacionalidade,
                    'numeroOrdem'=>$this->numeroOrdem,
                    'contribuente'=>$this->contribuente,
                    'provincia'=>Provincia::find($this->provincia)->descricao,
                    'municipio'=>$this->municipio,
                    'telefone'=>$this->telefone,
                    'genero'=>$this->genero,
                    'estado'=>$this->estado ?? 'Activo',
                    'biografia'=>$this->biografia,
                    'email'=>$this->email,
                    'imagem'=>$this->imagem ?? $enfermeiro->imagem,
                    'documentosAssociados'=>$this->documentosAssociados ?? $enfermeiro->documentosAssociados,
                  
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
            $this->enfermeiroId = $id;
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
           Enfermeiro::destroy($this->enfermeiroId);
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
            $this->especialidade_id = '';
            $this->nomeCompleto = '';
            $this->dataDeNascimento = '';
            $this->nacionalidade = '';
            $this->imagem = '';
            $this->documentosAssociados = '';
            $this->numeroOrdem = '';
            $this->contribuente = '';
            $this->provincia = '';
            $this->municipio = '';
            $this->dataDeVinculo = '';
            $this->telefone = '';
            $this->genero = '';
            $this->estado = '';
            $this->biografia = '';
            $this->enfermeiroId =   '';
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
