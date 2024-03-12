<?php

namespace App\Livewire\Login;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class LoginComponent extends Component
{
    use LivewireAlert;
    public $email,$password;
    public function render()
    {
        
        return view('livewire.login.login-component')->layout('layouts.login.app');
    }

    protected $regras = ['email'=>'required','password'=>'required'];
    protected $mensagens = ['email.required'=>'Obrigatório','password.required'=>'Obrigatório'];
    
    public function entrar()
    {
        $this->validate($this->regras,$this->mensagens);
        try {
            $user = User::where('email','=',$this->email)->first();
           
         

            if(!$user){

                Session()->put('message','Não existe uma conta com este e-mail!!!');
            
                return;
            }

 
            if($user->estado == 'Activa'){
                
                if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
                   
                    
                    if ($user->nivel == 'Administrador' ) {
                        $user->online = 'On';
                        $user->save();
                        return redirect()->route('sis.admin.home');
                    }elseif($user->nivel == 'Médico' ){
                        $user->online = 'On';
                        $user->save();
                        return redirect()->route('sis.medico.paciente-atendimento');
                    }elseif($user->nivel == 'Enfermeiro' ){
                        $user->online = 'On';
                        $user->save();
                        return redirect()->route('sis.enferm.triagem');
                    }else{
                        $user->online = 'On';
                        $user->save();
                        return redirect()->route('sis.atend.banco-de-urgencia');
                    }
            }else{
                Session()->put('message','Credências Inválidas!!!');
          
            }

            Session()->forget('message');
        }

        } catch (\Throwable $th) {
            
            session()->put('message','Falha ao realizar operação'.$th->getMessage());
           
        }
    }
}
