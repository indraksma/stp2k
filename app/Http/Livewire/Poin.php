<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class Poin extends Component
{
    use WithPagination, LivewireAlert;

    public function render()
    {
        return view('livewire.poin')->extends('layouts.app');
    }
}
