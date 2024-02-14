<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Siswa;
use Livewire\WithPagination;

class TabelSiswa extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $kelas_id, $searchTerm;

    public function mount($id)
    {
        $this->kelas_id = $id;
    }

    public function render()
    {
        $query = '%' . $this->searchTerm . '%';

        $siswa = Siswa::select('siswas.id', 'siswas.nama', 'siswas.nis', 'kelass.nama_kelas', 'siswas.jk', 'siswas.poin_siswa')->join('kelass', 'siswas.kelas_id', '=', 'kelass.id')->where('siswas.kelas_id', $this->kelas_id)->where(function ($sub_query) {
            $sub_query->where('nama', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('nis', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('jk', 'like', '%' . $this->searchTerm . '%');
        })->paginate(15);
        return view('livewire.tabel-siswa', ['siswa' => $siswa]);
    }
}
