<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Jurusan;
use App\Models\Kelas as ModelKelas;
use App\Models\TahunAjaran;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use App\Imports\KelasImport;
use App\Models\User;
use Livewire\WithFileUploads;

class Kelas extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $kelas_id, $nama_kelas, $jurusan_id, $tahun_ajaran_id, $template_excel;

    public $iteration = 0;

    public function render()
    {
        $kelas = ModelKelas::paginate(15);
        $jurusan = Jurusan::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('livewire.setting.kelas', [
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'tahun_ajaran' => $tahun_ajaran,
            'iteration' => $this->iteration,
        ])->extends('layouts.app');
    }

    private function resetInputFields()
    {
        $this->reset(['jurusan_id', 'kelas_id', 'nama_kelas', 'tahun_ajaran_id']);
        $this->iteration++;
        $this->resetErrorBag();
    }

    public function resetForm()
    {
        $this->reset(['jurusan_id', 'kelas_id', 'nama_kelas', 'tahun_ajaran_id']);
        $this->iteration++;
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

    public function import()
    {
        // dd($this->template_excel);
        $file_path = $this->template_excel->store('files', 'public');
        //dd($file_path);
        Excel::import(new KelasImport, storage_path('/app/public/' . $file_path));
        Storage::disk('public')->delete($file_path);

        $this->resetInputFields();
        $this->alert('success', 'Data berhasil diimport!');
    }
}
