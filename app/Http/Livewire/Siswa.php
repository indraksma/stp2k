<?php

namespace App\Http\Livewire;

use App\Models\Siswa as ModelsSiswa;
use App\Models\Kelas as ModelsKelas;
use App\Models\Jurusan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use Illuminate\Support\Facades\Storage;

use App\Imports\SiswaImport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Siswa extends Component
{
    use LivewireAlert, WithFileUploads, WithPagination;

    public $nama, $nis, $jk, $kelas_id, $siswa_id, $tempat_lahir, $tanggal_lahir, $riwayatsiswa, $riwayatpoin, $jurusan_list, $jurusan_id, $kelas_list, $pelanggaran, $cari_nama, $carisiswa;
    public $template_excel;
    public $openModal = false;
    public $iteration = 0;
    protected $listeners = ['edit', 'delete', 'detail'];
    protected $paginationTheme = 'bootstrap';

    public $showtable = false;
    public $showsearch = false;

    private $cekform = true;

    public function mount()
    {
        $this->jurusan_list = Jurusan::all();
    }

    public function render()
    {
        $kelas = ModelsKelas::all();
        return view('livewire.siswa', [
            'iteration' => $this->iteration,
            'kelas' => $kelas,
        ])->extends('layouts.app');
    }

    public function resetInputFields()
    {
        $this->reset(['nama', 'nis', 'jk', 'siswa_id', 'tempat_lahir', 'tanggal_lahir']);
        $this->iteration++;
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->openModal = true;
    }

    public function store()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'nama'      => ['required'],
            'nis'      => ['required'],
            'jk'      => ['required'],
            'kelas_id'      => ['required']
        ], $messages);

        ModelsSiswa::updateOrCreate(['id' => $this->siswa_id], [
            'nama'      => $this->nama,
            'nis'      => $this->nis,
            'jk'      => $this->jk,
            'kelas_id'      => $this->kelas_id,
            'tempat_lahir'      => $this->tempat_lahir,
            'tanggal_lahir'      => $this->tanggal_lahir,
        ]);

        $this->emit('refreshSiswaTable');
        $this->alert('success', $this->siswa_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->reset(['riwayatsiswa', 'riwayatpoin']);
        $this->openModal = false;
    }

    public function edit($id)
    {
        $siswa = ModelsSiswa::findOrFail($id);

        $this->siswa_id = $id;
        $this->nama = $siswa->nama;
        $this->nis = $siswa->nis;
        $this->tempat_lahir = $siswa->tempat_lahir;
        $this->tanggal_lahir = $siswa->tanggal_lahir;
        $this->jk = $siswa->jk;
        $this->kelas_id = $siswa->kelas_id;

        $this->openModal = true;
    }

    public function import()
    {
        // dd($this->template_excel);
        $file_path = $this->template_excel->store('files', 'public');
        //dd($file_path);
        Excel::import(new SiswaImport, storage_path('/app/public/' . $file_path));
        Storage::disk('public')->delete($file_path);

        $this->resetInputFields();
        $this->emit('refreshSiswaTable');
        $this->alert('success', 'Data berhasil diimport!');
    }

    public function delete($id)
    {
        $sql = ModelsSiswa::where('id', $id)->firstOrFail();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
        $this->emit('refreshSiswaTable');
    }

    public function detail($id)
    {
        $this->siswa_id = $id;
    }



    private function checkForm()
    {
        if ($this->jurusan_id == "") {
            $this->cekform = false;
        }
        if ($this->kelas_id == "") {
            $this->cekform = false;
        }
        if ($this->cekform) {
            $this->showtable = true;
        } else {
            $this->showtable = false;
        }
    }

    public function updatedJurusanId()
    {
        $this->kelas_id = '';
        $this->reset(['kelas_list', 'pelanggaran']);
        $this->kelas_list = ModelsKelas::select('kelass.id', 'kelass.nama_kelas')->join('tahun_ajarans', 'kelass.tahun_ajaran_id', '=', 'tahun_ajarans.id')->where('tahun_ajarans.aktif', 1)->where('kelass.jurusan_id', $this->jurusan_id)->get();
        $this->checkForm();
    }

    public function updatedKelasId()
    {
        $this->checkForm();
    }

    public function updatedCariNama()
    {
        $this->reset('carisiswa');
        $this->showsearch = false;
    }

    public function clearCariSiswa()
    {
        $this->reset(['carisiswa', 'cari_nama']);
        $this->showsearch = false;
    }

    public function cariSiswa()
    {
        $siswa = ModelsSiswa::select('siswas.id', 'siswas.nama', 'siswas.nis', 'siswas.kelas_id', 'siswas.jk', 'siswas.poin_siswa')->join('kelass', 'siswas.kelas_id', '=', 'kelass.id')->join('tahun_ajarans', 'kelass.tahun_ajaran_id', '=', 'tahun_ajarans.id')->where('tahun_ajarans.aktif', 1)->where('siswas.nama', 'LIKE', '%' . $this->cari_nama . '%')->get();
        $this->carisiswa = $siswa;
        $this->showsearch = true;
    }
}
