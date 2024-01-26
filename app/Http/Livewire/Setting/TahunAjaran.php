<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

use App\Models\TahunAjaran as Tahun_ajaran;
use App\Models\User;

class TahunAjaran extends Component
{
    use WithPagination, LivewireAlert;

    public $tahun_ajaran, $ta_id, $user_id;

    public function render()
    {
        $ta = Tahun_ajaran::orderBy('tahun_ajaran', 'ASC')->paginate(10);
        $users = User::all();
        return view('livewire.setting.tahun-ajaran', [
            'ta' => $ta,
            'user' => $users,
        ])->extends('layouts.app');
    }

    private function resetInputFields()
    {
        $this->reset(['ta_id', 'tahun_ajaran', 'user_id']);
        $this->resetErrorBag();
    }

    public function resetForm()
    {
        $this->reset(['ta_id', 'tahun_ajaran', 'user_id']);
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
            'tahun_ajaran'      => ['required'],
            'user_id'      => ['required'],
        ], $messages);

        if ($this->ta_id) {
            Tahun_ajaran::updateOrCreate(['id' => $this->ta_id], [
                'tahun_ajaran'      => $this->tahun_ajaran,
                'kepsek_id'      => $this->user_id
            ]);
        } else {
            Tahun_ajaran::updateOrCreate(['id' => $this->ta_id], [
                'tahun_ajaran'      => $this->tahun_ajaran,
                'kepsek_id'      => $this->user_id,
                'aktif'      => 0,
            ]);
        }

        $this->alert('success', $this->ta_id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $ta = Tahun_ajaran::findOrFail($id);

        $this->ta_id = $id;
        $this->user_id = $ta->kepsek_id;
        $this->tahun_ajaran = $ta->tahun_ajaran;
    }

    public function activate($id)
    {
        Tahun_ajaran::where('id', $id)->update(['aktif' => 1]);
        $this->alert('success', 'Aktivasi berhasil!');
    }

    public function deactivate($id)
    {
        Tahun_ajaran::where('id', $id)->update(['aktif' => 1]);
        $this->alert('success', 'Aktivasi berhasil!');
    }

    public function delete($id)
    {
        $sql = Tahun_ajaran::where('id', $id)->firstOrFail();

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
    }
}
