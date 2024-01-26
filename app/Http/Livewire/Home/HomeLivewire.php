<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class HomeLivewire extends Component
{
    public function render()
    {
        return view('livewire.home.index')->extends('layouts.app');
    }
}
