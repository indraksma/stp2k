<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\JenisPelanggaran;
use App\Models\KodePelanggaran;

class Pelanggaran extends Component
{
    use WithPagination, LivewireAlert;

    public $jenis_pelanggaran, $kode_pelanggaran, $nama_pelanggaran, $poin, $jp_id, $delete_id, $jenis_hapus, $kp_id, $jp_list;

    protected $listeners = ['editModalJP' => 'editModalJP', 'deleteId' => 'deleteId', 'editModalKP'  => 'editModalKP'];

    public function render()
    {
        return view('livewire.setting.pelanggaran')->extends('layouts.app');
    }

    private function resetForm()
    {
        $this->reset(['jenis_pelanggaran', 'kode_pelanggaran', 'nama_pelanggaran', 'poin', 'jp_id', 'kp_id', 'delete_id', 'jenis_hapus', 'jp_list']);
    }

    public function closeModal()
    {
        $this->resetForm();
    }

    public function createModalJP()
    {
        $this->resetForm();
    }

    public function createModalKP()
    {
        $this->resetForm();
        $this->jp_list = JenisPelanggaran::all();
    }

    public function editModalJP($id)
    {
        $this->jp_id = $id;
        $jp = JenisPelanggaran::find($id);
        $this->jenis_pelanggaran = $jp->jenis_pelanggaran;
    }

    public function editModalKP($id)
    {
        $this->kp_id = $id;
        $this->jp_list = JenisPelanggaran::all();
        $kp = KodePelanggaran::find($id);
        $this->jp_id = $kp->jenis_pelanggaran_id;
        $this->nama_pelanggaran = $kp->nama_pelanggaran;
        $this->kode_pelanggaran = $kp->kode_pelanggaran;
        $this->poin = $kp->poin;
    }

    public function storeJP()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'jenis_pelanggaran'      => ['required']
        ], $messages);

        JenisPelanggaran::updateOrCreate(['id' => $this->jp_id], [
            'jenis_pelanggaran'      => $this->jenis_pelanggaran,
        ]);

        $this->alert('success', $this->jp_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->resetForm();
        $this->emit('refreshJpTable');
        $this->dispatchBrowserEvent('storedData');
    }

    public function storeKP()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        $this->validate([
            'jp_id'      => ['required'],
            'nama_pelanggaran'      => ['required'],
            'kode_pelanggaran'      => ['required'],
            'poin'      => ['required'],
        ], $messages);

        KodePelanggaran::updateOrCreate(['id' => $this->kp_id], [
            'jenis_pelanggaran_id'      => $this->jp_id,
            'kode_pelanggaran'      => $this->kode_pelanggaran,
            'nama_pelanggaran'      => $this->nama_pelanggaran,
            'poin'      => $this->poin,
        ]);

        $this->alert('success', $this->kp_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->resetForm();
        $this->emit('refreshKpTable');
        $this->dispatchBrowserEvent('storedData');
    }

    public function deleteId($id, $jenis)
    {
        $this->delete_id = $id;
        $this->jenis_hapus = $jenis;
    }

    public function delete()
    {
        $jenis = $this->jenis_hapus;
        if ($jenis == 1) {
            JenisPelanggaran::where('id', $this->delete_id)->delete();
            $this->emit('refreshJpTable');
        } elseif ($jenis == 2) {
            KodePelanggaran::where('id', $this->delete_id)->delete();
            $this->emit('refreshKpTable');
        }

        $this->reset(['delete_id', 'jenis_hapus']);
        $this->alert('success', 'Data berhasil dihapus!');
    }
}
