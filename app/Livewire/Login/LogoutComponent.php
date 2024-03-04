<?php

namespace App\Livewire\Login;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutComponent extends Component
{
    public function render()
    {
        return view('livewire.login.logout-component');
    }

    public function sair()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
