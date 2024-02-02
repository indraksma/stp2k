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

class EditPoin extends Component
{
    use LivewireAlert;

    public $jp_id, $nis, $kp_id, $tanggal, $jp_list, $kp_list, $poin, $nama_siswa, $poin_siswa, $jk, $jurusan, $kelas, $siswa_id, $pelanggaran_id;
    public $showbtn = false;

    private $cekform = true;

    public function mount($id)
    {
        $datapoin = Pelanggaran::where('id', $id)->first();
        $this->pelanggaran_id = $datapoin->id;
        $this->siswa_id = $datapoin->siswa_id;
        $this->tanggal = $datapoin->tanggal;
        $this->jp_id = $datapoin->kode_pelanggaran->jenis_pelanggaran_id;
        $this->jp_list = JenisPelanggaran::all();
        $this->kp_id = $datapoin->kode_pelanggaran_id;
        $this->kp_list = KodePelanggaran::where('jenis_pelanggaran_id', $datapoin->kode_pelanggaran->jenis_pelanggaran_id)->get();
        $this->poin = $datapoin->poin;
        $this->jurusan = $datapoin->siswa->kelas->jurusan->kode_jurusan;
        $this->kelas = $datapoin->siswa->kelas->nama_kelas;
        $this->nama_siswa = $datapoin->siswa->nama;
        $this->poin_siswa = $datapoin->siswa->poin_siswa;
        $this->nis = $datapoin->siswa->nis;
        $this->jk = $datapoin->siswa->jk;
        $this->checkForm();
    }

    public function render()
    {
        return view('livewire.edit-poin')->extends('layouts.app');
    }

    private function checkForm()
    {
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
            'tanggal'      => ['required'],
        ], $messages);

        $datapoin = Pelanggaran::where('id', $this->pelanggaran_id)->first();

        $siswa = Siswa::where('id', $this->siswa_id)->first();
        $poinsiswa = $siswa->poin_siswa;
        $poinasli = intval($poinsiswa) - intval($datapoin->poin);
        $poinupdate = intval($poinasli) + intval($this->poin);
        $siswa->poin_siswa = $poinupdate;
        $siswa->update();

        $datapoin->kode_pelanggaran_id = $this->kp_id;
        $datapoin->tanggal      = $this->tanggal;
        $datapoin->poin = $this->poin;
        $datapoin->update();

        $this->alert('success', 'Data berhasil diubah!');
        return redirect()->route('datapelanggaran');
    }
}
