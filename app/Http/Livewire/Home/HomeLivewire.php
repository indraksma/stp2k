<?php

namespace App\Http\Livewire\Home;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Livewire\Component;

class HomeLivewire extends Component
{
    public function render()
    {
        $pelanggaran = Pelanggaran::latest()->take(10)->get();
        $siswa = Siswa::select('nama', 'nama_kelas', 'poin_siswa')->join('kelass', 'siswas.kelas_id', '=', 'kelass.id')->join('tahun_ajarans', 'kelass.tahun_ajaran_id', '=', 'tahun_ajarans.id')->where('tahun_ajarans.aktif', 1)->where('poin_siswa', '>', 0)->orderBy('poin_siswa', 'DESC')->take(10)->get();
        return view('livewire.home.index', [
            'riwayat' => $pelanggaran,
            'siswa' => $siswa,
        ])->extends('layouts.app');
    }
}
