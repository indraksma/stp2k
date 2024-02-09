<?php

namespace App\Http\Livewire;

use App\Models\PenguranganPoin as ModelsPenguranganPoin;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PenguranganPoin extends Component
{
    use WithPagination, LivewireAlert;

    public $pengurangan_id, $jurusan_id, $kelas_id, $siswa_id, $tanggal, $kelas_list, $jurusan_list, $siswa_list, $poin, $nama_siswa, $poin_siswa, $jk, $keterangan;
    public $showbtn = false;

    private $cekform = true;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->jurusan_list = Jurusan::orderBy('kode_jurusan', 'ASC')->get();
    }

    public function render()
    {
        $data = ModelsPenguranganPoin::latest()->paginate(10);
        return view('livewire.pengurangan-poin', [
            'data' => $data,
        ])->extends('layouts.app');
    }

    private function checkForm()
    {
        if ($this->jurusan_id == "") {
            $this->cekform = false;
        }
        if ($this->kelas_id == "") {
            $this->cekform = false;
        }
        if ($this->siswa_id == "") {
            $this->cekform = false;
        }
        if ($this->poin == "") {
            $this->cekform = false;
        }
        if ($this->keterangan == "") {
            $this->cekform = false;
        }
        if ($this->tanggal == "") {
            $this->cekform = false;
        }
        if ($this->cekform) {
            if ($this->poin_siswa == 0) {
                $this->showbtn = false;
            } else {
                $this->showbtn = true;
            }
        } else {
            $this->showbtn = false;
        }
    }

    public function updatedJurusanId()
    {
        $this->kelas_id = '';
        $this->reset(['kelas_list', 'siswa_list', 'siswa_id']);
        $this->kelas_list = Kelas::select('kelass.id', 'kelass.nama_kelas')->join('tahun_ajarans', 'kelass.tahun_ajaran_id', '=', 'tahun_ajarans.id')->where('tahun_ajarans.aktif', 1)->where('kelass.jurusan_id', $this->jurusan_id)->get();
        $this->checkForm();
    }

    public function updatedKelasId()
    {
        $this->reset(['siswa_list', 'siswa_id']);
        $this->siswa_id = '';
        $this->siswa_list = Siswa::where('kelas_id', $this->kelas_id)->orderBy('nis', 'ASC')->get();
        $this->checkForm();
    }

    public function updatedSiswaId()
    {
        $siswa = Siswa::find($this->siswa_id);
        $this->nama_siswa = $siswa->nama;
        if ($siswa->poin_siswa == NULL || $siswa->poin_siswa == "") {
            $this->poin_siswa = 0;
        } else {
            $this->poin_siswa = $siswa->poin_siswa;
        }
        $this->jk = $siswa->jk;
        $this->checkForm();
    }

    public function updatedPoin()
    {
        $this->checkForm();
    }

    public function updatedKeterangan()
    {
        $this->checkForm();
    }

    private function resetForm()
    {
        $this->reset(['pengurangan_id', 'jurusan_id', 'siswa_id', 'kelas_id', 'poin', 'poin_siswa', 'keterangan', 'jk', 'nama_siswa', 'kelas_list', 'siswa_list']);
    }

    public function closeModal()
    {
        $this->resetForm();
    }

    public function store()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'tanggal'      => ['required'],
            'siswa_id'      => ['required'],
            'keterangan'      => ['required'],
            'poin'      => ['required', 'numeric'],
        ], $messages);

        $siswa = Siswa::where('id', $this->siswa_id)->first();
        $siswa->poin_siswa = $siswa->poin_siswa - $this->poin;
        $siswa->update();

        ModelsPenguranganPoin::updateOrCreate(['id' => $this->pengurangan_id], [
            'tanggal'      => $this->tanggal,
            'siswa_id'      => $this->siswa_id,
            'user_id'      => Auth::user()->id,
            'keterangan'      => $this->keterangan,
            'poin'      => $this->poin,
        ]);

        $this->alert('success', $this->siswa_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->showbtn = false;
        $this->closeModal();
    }

    public function delete($id)
    {
        $sql = ModelsPenguranganPoin::where('id', $id)->firstOrFail();

        $siswa = Siswa::where('id', $sql->siswa_id)->first();
        $poinsiswa = intval($siswa->poin_siswa) + intval($sql->poin);
        $siswa->poin_siswa = $poinsiswa;
        $siswa->update();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
    }
}
