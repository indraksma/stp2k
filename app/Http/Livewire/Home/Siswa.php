<?php

namespace App\Http\Livewire\Home;

use App\Models\Pengaduan;
use App\Models\Siswa as ModelsSiswa;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class Siswa extends Component
{
    use LivewireAlert, WithFileUploads;

    public $nis, $siswa_id, $nama, $topik, $aduan, $dokumentasi, $kelas, $nis_aduan;
    public $showcek = false;

    protected $rules = [
        'topik' => 'required',
        'aduan' => 'required',
        'dokumentasi' => 'nullable|image|max:2048',
    ];

    public function render()
    {
        return view('livewire.home.siswa')->extends('layouts.home');
    }

    public function ceksiswa()
    {
        $this->showcek = true;
    }

    public function cekpoin()
    {
        $this->reset(['siswa_id']);
        $siswa = ModelsSiswa::where('nis', $this->nis)->first();
        if ($siswa !== NULL) {
            $this->siswa_id = $siswa->id;
        } else {
            $this->siswa_id = false;
        }
    }

    public function home()
    {
        $this->showcek = false;
        $this->reset(['nis', 'siswa_id']);
    }

    public function store()
    {
        $this->validate();

        $name = NULL;
        if ($this->dokumentasi) {
            $name = md5($this->dokumentasi . microtime()) . '.' . $this->dokumentasi->extension();
            $this->dokumentasi->storeAs('img/aduan/', $name, 'public');
        }

        Pengaduan::create([
            'nama' => $this->nama,
            'nis' => $this->nis_aduan,
            'kelas' => $this->kelas,
            'topik' => $this->topik,
            'aduan' => $this->aduan,
            'dokumentasi' => $name,
        ]);

        $this->reset(['nama', 'topik', 'aduan', 'dokumentasi', 'kelas', 'nis_aduan']);
        $this->alert('success', 'Pengaduan berhasil dikirimkan');
        $this->dispatchBrowserEvent('closeModal');
    }
}
