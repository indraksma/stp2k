<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Jurusan;
use App\Models\Kelas as ModelKelas;
use App\Models\TahunAjaran;

class Kelas extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $kelas_id, $nama_kelas, $jurusan_id, $tahun_ajaran_id;

    public function render()
    {
        $kelas = ModelKelas::paginate(15);
        $jurusan = Jurusan::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('livewire.setting.kelas', ['kelas' => $kelas, 'jurusan' => $jurusan, 'tahun_ajaran' => $tahun_ajaran])->extends('layouts.app');
    }

    private function resetInputFields()
    {
        $this->reset(['jurusan_id', 'kelas_id', 'nama_kelas', 'tahun_ajaran_id']);
        $this->resetErrorBag();
    }

    public function resetForm()
    {
        $this->reset(['jurusan_id', 'kelas_id', 'nama_kelas', 'tahun_ajaran_id']);
        $this->resetErrorBag();
    }

    public function store()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'nama_kelas'      => ['required'],
            'jurusan_id'      => ['required'],
            'tahun_ajaran_id'      => ['required']
        ], $messages);

        ModelKelas::updateOrCreate(['id' => $this->kelas_id], [
            'nama_kelas'      => $this->nama_kelas,
            'jurusan_id'      => $this->jurusan_id,
            'tahun_ajaran_id'      => $this->tahun_ajaran_id,
        ]);

        $this->alert('success', $this->kelas_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $kelas = ModelKelas::findOrFail($id);

        $this->kelas_id = $id;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->jurusan_id = $kelas->jurusan_id;
        $this->tahun_ajaran_id = $kelas->tahun_ajaran_id;
    }

    public function delete($id)
    {
        $sql = ModelKelas::where('id', $id)->firstOrFail();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
    }
}
