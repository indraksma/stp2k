<?php

namespace App\Http\Livewire\Home;

use App\Models\Siswa as ModelsSiswa;
use Livewire\Component;

class Siswa extends Component
{
    public $nis, $siswa_id;
    public $showcek = false;

    public function render()
    {
        return view('livewire.home.siswa')->extends('layouts.home');
    }

    public function ceksiswa()
    {
        $this->showcek = true;
    }

    public function cekpoin()
    {
        $this->reset(['siswa_id']);
        $siswa = ModelsSiswa::where('nis', $this->nis)->first();
        if ($siswa !== NULL) {
            $this->siswa_id = $siswa->id;
        } else {
            $this->siswa_id = false;
        }
    }

    public function home()
    {
        $this->showcek = false;
        $this->reset(['nis', 'siswa_id']);
    }
}
