<?php

namespace App\Livewire\Administrador;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.administrador.home-component')->layout('layouts.administrador.app');
    }
}
