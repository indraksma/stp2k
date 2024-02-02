<?php

namespace App\Http\Livewire;

use App\Models\JenisPelanggaran;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\KodePelanggaran;
use App\Models\Pelanggaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AddPoin extends Component
{
    use LivewireAlert;

    public $jp_id, $jurusan_id, $kelas_id, $siswa_id, $kp_id, $tanggal, $kelas_list, $jurusan_list, $jp_list, $kp_list, $siswa_list, $poin, $nama_siswa, $poin_siswa, $jk;
    public $showbtn = false;

    private $cekform = true;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->jp_list = JenisPelanggaran::all();
        $this->jurusan_list = Jurusan::orderBy('kode_jurusan', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.add-poin')->extends('layouts.app');
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
        if ($this->jp_id == "") {
            $this->cekform = false;
        }
        if ($this->kp_id == "") {
            $this->cekform = false;
        }
        if ($this->tanggal == "") {
            $this->cekform = false;
        }
        if ($this->cekform) {
            $this->showbtn = true;
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

    public function updatedJpId()
    {
        $this->kp_id = '';
        $this->reset(['kp_list', 'poin']);
        $this->kp_list = KodePelanggaran::where('jenis_pelanggaran_id', $this->jp_id)->get();
        $this->checkForm();
    }

    public function updatedKpId()
    {
        $this->reset('poin');
        if ($this->kp_id != "") {
            $kp = KodePelanggaran::where('id', $this->kp_id)->first();
            $this->poin = $kp->poin;
        }
        $this->checkForm();
    }

    public function store()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'kp_id'      => ['required'],
            'siswa_id'      => ['required'],
            'tanggal'      => ['required'],
        ], $messages);

        Pelanggaran::create([
            'kode_pelanggaran_id'      => $this->kp_id,
            'siswa_id'      => $this->siswa_id,
            'tanggal'      => $this->tanggal,
            'user_id'   => Auth::user()->id,
            'poin'      => $this->poin,
        ]);

        $siswa = Siswa::where('id', $this->siswa_id)->first();
        $poinsiswa = $siswa->poin_siswa;
        $poin = intval($poinsiswa) + intval($this->poin);
        $siswa->poin_siswa = $poin;
        $siswa->update();

        $this->alert('success', 'Data berhasil ditambahkan!');
        return redirect()->route('datapelanggaran');
    }
}
