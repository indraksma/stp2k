<?php

namespace App\Http\Livewire;

use App\Models\Siswa;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\DB;
use App\Models\RiwayatKenaikan;
use Illuminate\Support\Facades\Auth;

class KenaikanKelas extends Component
{
    use LivewireAlert;

    public function render()
    {
        $riwayatkenaikan = RiwayatKenaikan::all();
        return view('livewire.kenaikan-kelas', [
            'riwayat' => $riwayatkenaikan,
        ])->extends('layouts.app');
    }

    public function proses()
    {
        $siswa = Siswa::select('poin_siswa')->join('kelass', 'siswas.kelas_id', '=', 'kelass.id')->join('tahun_ajarans', 'kelass.tahun_ajaran_id', '=', 'tahun_ajarans.id')->where('tahun_ajarans.aktif', 1)->where('poin_siswa', '>', 0)->update(['poin_siswa' => DB::raw('poin_siswa * 0.5')]);

        if ($siswa) {
            RiwayatKenaikan::create([
                'user_id' => Auth::user()->id,
            ]);
            $this->alert('success', 'Proses pengurangan poin berhasil dilakukan!');
        }
    }
}
