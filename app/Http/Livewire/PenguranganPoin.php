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

    public $pengurangan_id, $jurusan_id, $kelas_id, $siswa_id, $tanggal, $kelas_list, $jurusan_list, $siswa_list, $poin, $nis, $poin_siswa, $jk, $keterangan, $searchTerm;
    public $showbtn = false;
    public $alertMinus = false;

    private $cekform = true;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->jurusan_list = Jurusan::orderBy('kode_jurusan', 'ASC')->get();
    }

    public function render()
    {
        $data = ModelsPenguranganPoin::select('pengurangan_poins.id', 'pengurangan_poins.tanggal', 'pengurangan_poins.poin', 'pengurangan_poins.keterangan', 'siswas.nama', 'siswas.nis', 'kelass.nama_kelas')->join('siswas', 'pengurangan_poins.siswa_id', '=', 'siswas.id')->join('kelass', 'siswas.kelas_id', '=', 'kelass.id')->where(function ($sub_query) {
            if (date_parse($this->searchTerm)) {
                $tanggal = date('Y-m-d', strtotime($this->searchTerm));
            } else {
                $tanggal = $this->searchTerm;
            }
            $sub_query->where('pengurangan_poins.tanggal', 'like', '%' . $tanggal . '%')
                ->orWhere('siswas.nama', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('siswas.nis', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('kelass.nama_kelas', 'like', '%' . $this->searchTerm . '%');
        })->orderBy('tanggal', 'DESC')->paginate(10);
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
            $poinakhir = $this->poin_siswa - $this->poin;
            if ($this->poin_siswa == 0) {
                $this->showbtn = false;
            } elseif ($poinakhir < 0) {
                $this->alertMinus = true;
                $this->showbtn = false;
            } else {
                $this->alertMinus = false;
                $this->showbtn = true;
            }
        } else {
            $this->alertMinus = false;
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
        $this->reset(['pengurangan_id', 'jurusan_id', 'siswa_id', 'kelas_id', 'poin', 'poin_siswa', 'keterangan', 'jk', 'nis', 'kelas_list', 'siswa_list']);
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
            'keterangan'      => ['required'],
            'poin'      => ['required', 'numeric'],
        ], $messages);

        $siswa = Siswa::where('id', $this->siswa_id)->first();
        $siswa->poin_siswa = $siswa->poin_siswa - $this->poin;
        $siswa->update();

        ModelsPenguranganPoin::create([
            'tanggal'      => $this->tanggal,
            'siswa_id'      => $this->siswa_id,
            'user_id'      => Auth::user()->id,
            'keterangan'      => $this->keterangan,
            'poin'      => $this->poin,
        ]);

        $this->alert('success', 'Data berhasil ditambahkan!');
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
