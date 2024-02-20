<?php

namespace App\Livewire\Administrador;

use App\Models\Instituicao;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
class InstituicaoComponent extends Component
{
    use LivewireAlert,WithFileUploads;
    public $descricao,$telefone,$email,$pais,$provincia,$municipio,$endereco,$logotipo;
    protected $regras = [
    'descricao'=>'required',
    'telefone'=>'required',
    'email'=>'required',
    'pais'=>'required',
    'provincia'=>'required',
    'municipio'=>'required',
    'endereco'=>'required',
    ];
    protected $mensagens = [
    'descricao.required'=>'Obrigatório',
    'telefone.required'=>'Obrigatório',
    'email.required'=>'Obrigatório',
    'pais.required'=>'Obrigatório',
    'provincia.required'=>'Obrigatório',
    'municipio.required'=>'Obrigatório',
    'endereco.required'=>'Obrigatório',
    ];
    public function mount()
    {
        try {

            $instituicao = Instituicao::first();
            if ($instituicao) {
                $this->descricao = $instituicao->descricao;
                $this->telefone = $instituicao->telefone;
                $this->email = $instituicao->email;
                $this->pais = $instituicao->pais;
                $this->provincia = $instituicao->provincia;
                $this->municipio = $instituicao->municipio;
                $this->endereco = $instituicao->endereco;
                $this->logotipo = $instituicao->logotipo;
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

    public function salvarOuActualizar()
    {
        $this->validate($this->regras,$this->mensagens);
        try {
            $instituicao = Instituicao::first();
            if ($instituicao) {
                if ($this->logotipo != null and !is_string($this->logotipo)) {

                    $extensao = $this->logotipo->getclientOriginalExtension();
                    $nomeDologotipo = md5($this->logotipo->getclientOriginalName()).'.'. $extensao;
                    $this->logotipo->storeAs('/public/logotipo/',$nomeDologotipo);
                    $instituicao->update([
                        'descricao'=>$this->descricao,
                        'telefone'=>$this->telefone,
                        'email'=>$this->email,
                        'pais'=>$this->pais,
                        'provincia'=>$this->provincia,
                        'municipio'=>$this->municipio,
                        'endereco'=>$this->endereco,
                        'logotipo'=>$nomeDologotipo,
                    ]);
                    
                }else{
                    $instituicao->update([
                        'descricao'=>$this->descricao,
                        'telefone'=>$this->telefone,
                        'email'=>$this->email,
                        'pais'=>$this->pais,
                        'provincia'=>$this->provincia,
                        'municipio'=>$this->municipio,
                        'endereco'=>$this->endereco,
                    ]);
                }
            }else{
                if ($this->logotipo != null and !is_string($this->logotipo)) {

                    $extensao = $this->logotipo->getclientOriginalExtension();
                    $nomeDologotipo = md5($this->logotipo->getclientOriginalName()).'.'. $extensao;
                    $this->logotipo->storeAs('/public/logotipo/',$nomeDologotipo);
                    Instituicao::create([
                        'descricao'=>$this->descricao,
                        'telefone'=>$this->telefone,
                        'email'=>$this->email,
                        'pais'=>$this->pais,
                        'provincia'=>$this->provincia,
                        'municipio'=>$this->municipio,
                        'endereco'=>$this->endereco,
                        'logotipo'=>$nomeDologotipo,
                    ]);

                }else{
                    Instituicao::create([
                        'descricao'=>$this->descricao,
                        'telefone'=>$this->telefone,
                        'email'=>$this->email,
                        'pais'=>$this->pais,
                        'provincia'=>$this->provincia,
                        'municipio'=>$this->municipio,
                        'endereco'=>$this->endereco,
                    ]);
                }
            }

            $this->alert('success', 'SUCESSO', [
                'position' => 'center',
                'toast' => false,
                'timer' => 2000,
                'text'=>'Operação Realizada com sucesso'
            ]);
            
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
    public function render()
    {
        return view('livewire.administrador.instituicao-component')->layout('layouts.administrador.app');
    }



}
