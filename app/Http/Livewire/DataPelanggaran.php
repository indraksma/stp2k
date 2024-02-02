<?php

namespace App\Http\Livewire;

use App\Models\Pelanggaran;
use App\Models\Siswa;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class DataPelanggaran extends Component
{
    use LivewireAlert;
    protected $listeners = ['edit', 'delete'];

    public function render()
    {
        return view('livewire.data-pelanggaran')->extends('layouts.app');
    }

    public function delete($id)
    {
        $sql = Pelanggaran::where('id', $id)->firstOrFail();

        $siswa = Siswa::where('id', $sql->siswa_id)->first();
        $poinsiswa = intval($siswa->poin_siswa) - intval($sql->poin);
        $siswa->poin_siswa = $poinsiswa;
        $siswa->update();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
        $this->emit('refreshPelanggaranTable');
    }

    public function edit($id)
    {
        return redirect()->route('editpoin', ['id' => $id]);
    }
}
