<?php

namespace App\Http\Livewire;


use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Penanganan as ModelsPenanganan;
use App\Models\Siswa;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Penanganan extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    private $cekform = true;

    public $showbtn = false;
    public $iteration = 0;
    public $tanggal, $jurusan_list, $searchTerm, $jurusan_id, $kelas_id, $kelas_list, $siswa_id, $siswa_list, $nis, $jk, $poin_siswa, $permasalahan, $tl, $hasil, $pihakterlibat, $dokumentasi;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->jurusan_list = Jurusan::orderBy('kode_jurusan', 'ASC')->get();
    }

    public function render()
    {
        $data = ModelsPenanganan::orderBy('tanggal', 'DESC')->paginate(10);
        return view('livewire.penanganan', [
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
        if ($this->permasalahan == "") {
            $this->cekform = false;
        }
        if ($this->tl == "") {
            $this->cekform = false;
        }
        if ($this->hasil == "") {
            $this->cekform = false;
        }
        if ($this->pihakterlibat == "") {
            $this->cekform = false;
        }
        if ($this->tanggal == "") {
            $this->cekform = false;
        }
        if ($this->cekform) {
            if ($this->poin_siswa < 25) {
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
        $this->nis = $siswa->nis;
        if ($siswa->poin_siswa == NULL || $siswa->poin_siswa == "") {
            $this->poin_siswa = 0;
        } else {
            $this->poin_siswa = $siswa->poin_siswa;
        }
        $this->jk = $siswa->jk;
        $this->checkForm();
    }

    public function updatedPermasalahan()
    {
        $this->checkForm();
    }

    public function updatedTl()
    {
        $this->checkForm();
    }

    public function updatedHasil()
    {
        $this->checkForm();
    }
    public function updatedPihakterlibat()
    {
        $this->checkForm();
    }

    private function resetForm()
    {
        $this->reset(['jurusan_id', 'siswa_id', 'kelas_id', 'poin_siswa', 'keterangan', 'jk', 'nis', 'kelas_list', 'siswa_list']);
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->dispatchBrowserEvent('closeModalTambah');
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
            'permasalahan'      => ['required'],
            'tl'      => ['required'],
            'hasil'      => ['required'],
            'pihakterlibat'      => ['required'],
        ], $messages);

        if ($this->dokumentasi) {
            $file_path = $this->dokumentasi->store('img/dokumentasi', 'public');
        } else {
            $file_path = NULL;
        }

        ModelsPenanganan::create([
            'tanggal'      => $this->tanggal,
            'siswa_id'      => $this->siswa_id,
            'user_id'      => Auth::user()->id,
            'permasalahan'      => $this->permasalahan,
            'tindak_lanjut'      => $this->tl,
            'hasil'      => $this->hasil,
            'pihak_terlibat'      => $this->pihakterlibat,
            'dokumentasi'      => $file_path,
        ]);

        $this->alert('success', 'Data berhasil ditambahkan!');
        $this->showbtn = false;
        $this->closeModal();
    }

    public function delete($id)
    {
        $sql = ModelsPenanganan::where('id', $id)->firstOrFail();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
    }
}
