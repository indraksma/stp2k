<?php

namespace App\Http\Livewire;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;

class DetailSiswa extends Component
{
    use WithPagination;

    public $idsiswa;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $riwayatsiswa = Siswa::where('id', $this->idsiswa)->first();
        $riwayatpoin = Pelanggaran::where('siswa_id', $this->idsiswa)->paginate(10);
        return view('livewire.detail-siswa', [
            'riwayatsiswa' => $riwayatsiswa,
            'riwayatpoin' => $riwayatpoin,
        ]);
    }
}
