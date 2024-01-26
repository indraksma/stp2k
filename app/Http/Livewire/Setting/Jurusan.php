<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\Jurusan as ModelJurusan;

class Jurusan extends Component
{
    use WithPagination, LivewireAlert;

    public $nama_jurusan, $kode_jurusan, $jurusan_id;

    public function render()
    {
        $jur = ModelJurusan::paginate(10);
        return view('livewire.setting.jurusan', ['jur' => $jur])->extends('layouts.app');
    }

    private function resetInputFields()
    {
        $this->reset(['jurusan_id', 'nama_jurusan', 'kode_jurusan']);
        $this->resetErrorBag();
    }

    public function resetForm()
    {
        $this->reset(['jurusan_id', 'nama_jurusan', 'kode_jurusan']);
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
            'nama_jurusan'      => ['required'],
            'kode_jurusan'      => ['required']
        ], $messages);

        ModelJurusan::updateOrCreate(['id' => $this->jurusan_id], [
            'nama_jurusan'      => $this->nama_jurusan,
            'kode_jurusan'      => $this->kode_jurusan,
        ]);

        $this->alert('success', $this->jurusan_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $jur = ModelJurusan::findOrFail($id);

        $this->jurusan_id = $id;
        $this->nama_jurusan = $jur->nama_jurusan;
        $this->kode_jurusan = $jur->kode_jurusan;
    }

    public function delete($id)
    {
        $sql = ModelJurusan::where('id', $id)->firstOrFail();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
    }
}
