<?php

namespace App\Http\Livewire;

use App\Models\JenisPelanggaran;
use App\Models\KodePelanggaran as ModelsKodePelanggaran;
use Livewire\Component;

class KodePelanggaran extends Component
{
    public function render()
    {
        $kp = [];
        $jp = JenisPelanggaran::all();
        foreach ($jp as $datajp) {
            $kp[$datajp->id] = ModelsKodePelanggaran::where('jenis_pelanggaran_id', $datajp->id)->get();
        }
        return view('livewire.kode-pelanggaran', ['jp' => $jp, 'kp' => $kp])->extends('layouts.app');
    }
}
