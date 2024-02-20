<?php

namespace App\Livewire\Atendente;

use App\Models\Municipio;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Paciente;
use App\Models\Pais;
use App\Models\Provincia;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PacienteComponent extends Component
{
  
        use WithFileUploads;
        use LivewireAlert;
        public $pacienteId,$pesquisar,$mostrar = 5,$nomeCompleto,$dataDeNascimento,$idade,$nacionalidade,$imagem,$nomeDoPai,
                $nomeDaMae,$contribuente,$provincia,$municipio,$bairro,$endereco,
                $telefone, $genero,$grupoSanguinio,$email,$cadastroRecente,$todosMunicipios =[];
    public function render()
    {
        
        return view('livewire.atendente.paciente-component',[
            'pacientes'=>$this->listar($this->pesquisar,$this->mostrar),
            'nacionalidades'=>$this->pegarPais(),
            'provincias'=>$this->pegarProvincias(),
        ])->layout('layouts.atendente.app');
    }

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
   
    protected $listeners = ['redirecionar'=>'redirecionar','excluir'=>'excluir','fecharModal'=>'fecharModal'];
   
    protected $mensagens = [
 
        'nomeCompleto.required'=>'Obrigatório',
        'nomeCompleto.unique'=>'Já existe',
        'dataDeNascimento.required'=>'Obrigatório',
        'nacionalidade.required'=>'Obrigatório',
        'nomeDoPai.required'=>'Obrigatório',
        'nomeDaMae.required'=>'Obrigatório',
        'contribuente.required'=>'Obrigatório',
        'provincia.required'=>'Obrigatório',
        'municipio.required'=>'Obrigatório',
        'bairro.required'=>'Obrigatório',
        'endereco.required'=>'Obrigatório',
        'telefone.required'=>'Obrigatório',
        'genero.required'=>'Obrigatório',
        'grupoSanguinio.required'=>'Obrigatório',
     
    ];
     
 
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
 

    public function listar($pesquisar = null,$mostrar = 5)
    {
        try {

            if($pesquisar != null and $mostrar != null)
            {
              return  Paciente::where('nomeCompleto','like','%'.$pesquisar.'%')
                ->orderBy('nomeCompleto','asc')
                ->limit($mostrar)
                ->get();
            }else{

               return Paciente::orderBy('nomeCompleto','desc')
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
        DB::beginTransaction();
        $this->validate([
            'nomeCompleto'=>'required|unique:pacientes,nomeCompleto',
            'dataDeNascimento'=>'required',
            'nacionalidade'=>'required',
            'nomeDoPai'=>'required',
            'nomeDaMae'=>'required',
            'contribuente'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'endereco'=>'required',
            'telefone'=>'required',
            'genero'=>'required',
            'grupoSanguinio'=>'required',
        ],$this->mensagens);
        try {
           
           
                
              $paciente =   Paciente::create([
                    'nomeCompleto'=>$this->nomeCompleto,
                    'dataDeNascimento'=>$this->dataDeNascimento,
                    'idade'=>Carbon::parse($this->dataDeNascimento)->age,
                    'nacionalidade'=>$this->nacionalidade,
                    'nomeDoPai'=>$this->nomeDoPai,
                    'nomeDaMae'=>$this->nomeDaMae,
                    'contribuente'=>$this->contribuente,
                    'provincia'=>Provincia::find($this->provincia)->descricao,
                    'municipio'=>$this->municipio,
                    'bairro'=>$this->bairro,
                    'endereco'=>$this->endereco,
                    'telefone'=>$this->telefone,
                    'genero'=>$this->genero,
                    'grupoSanguinio'=>$this->grupoSanguinio,
                    'email'=>$this->email,
                ]);
       
               
       
            $this->limparCampos();
            $this->darEntradaNoBancoDeUrgencia($paciente->id);
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

            $paciente =   Paciente::find($id);
             
            $this->nomeCompleto = $paciente->nomeCompleto;
            $this->dataDeNascimento = $paciente->dataDeNascimento;
            $this->nacionalidade = $paciente->nacionalidade;
            $this->imagem = $paciente->imagem;
            $this->nomeDoPai = $paciente->nomeDoPai;
            $this->nomeDaMae = $paciente->nomeDaMae;
            $this->contribuente = $paciente->contribuente;
            $this->provincia = $paciente->provincia;
            $this->municipio = $paciente->municipio;
            $this->bairro = $paciente->bairro;
            $this->endereco = $paciente->endereco;
            $this->telefone = $paciente->telefone;
            $this->genero = $paciente->genero;
            $this->grupoSanguinio = $paciente->grupoSanguinio;
            $this->pacienteId =   $paciente->id;
            $this->email =   $paciente->email;
   
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
            'nomeCompleto'=>'required|unique:pacientes,nomeCompleto,'.$this->pacienteId,
            'dataDeNascimento'=>'required',
            'nacionalidade'=>'required',
            'nomeDoPai'=>'required',
            'nomeDaMae'=>'required',
            'contribuente'=>'required',
            'provincia'=>'required',
            'municipio'=>'required',
            'bairro'=>'required',
            'endereco'=>'required',
            'telefone'=>'required',
            'genero'=>'required',
            'grupoSanguinio'=>'required',
        ],$this->mensagens);
        try {
            

             
                $this->alert('success', 'SUCESSO', [
                    'position' => 'center',
                    'toast' => false,
                    'timer' => 2000,
                    'text'=>'Operação Realizada com sucesso'
                ]);
          
                Paciente::find($this->pacienteId)->update([
                    'nomeCompleto'=>$this->nomeCompleto,
                    'dataDeNascimento'=>$this->dataDeNascimento,
                    'idade'=>Carbon::parse($this->dataDeNascimento)->age,
                    'nacionalidade'=>$this->nacionalidade,
                    'nomeDoPai'=>$this->nomeDoPai,
                    'nomeDaMae'=>$this->nomeDaMae,
                    'contribuente'=>$this->contribuente,
                    'provincia'=>$this->provincia,
                    'municipio'=>$this->municipio,
                    'bairro'=>$this->bairro,
                    'endereco'=>$this->endereco,
                    'telefone'=>$this->telefone,
                    'genero'=>$this->genero,
                    'grupoSanguinio'=>$this->grupoSanguinio,
                    'email'=>$this->email,
     
                  
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
            $this->pacienteId = $id;
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

    public function darEntradaNoBancoDeUrgencia($id){
        try{
         $this->cadastroRecente = $id;
            $this->alert('question', 'TEM A CERTEZA', [
                'icon' => 'warning',
                'position' => 'center',
                'toast' => false,
                'timer' => null,
                'text' => '(Operação Realizada com sucesso) Deseja Dar entrada no banco de urgência?',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Agora não',
                'confirmButtonText' => 'Dar Entrada',
                'confirmButtonColor' => '#3085d6',
                'cancelButtonColor' => '#d33',
                'onConfirmed' => 'redirecionar' 
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

    public function redirecionar()
    {
        try {
            Session::put('paciente',$this->cadastroRecente);
            return redirect()->route('sis.banco.de.urgencia');
        } catch (\Throwable $th) {
            $this->alert('error', 'FALHA', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text' => 'Falha ao realizar operação',
            ]);
        }
    }

    public function excluir(){
        try{
           Paciente::destroy($this->pacienteId);
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
            $this->imagem = '';
            $this->nomeDoPai = '';
            $this->nomeDaMae = '';
            $this->contribuente = '';
            $this->provincia = '';
            $this->municipio = '';
            $this->bairro = '';
            $this->endereco = '';
            $this->telefone = '';
            $this->genero = '';
            $this->grupoSanguinio = '';
            $this->pacienteId =   '';
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
