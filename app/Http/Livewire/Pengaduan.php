<?php

namespace App\Http\Livewire;

use App\Models\Pengaduan as ModelsPengaduan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Pengaduan extends Component
{
    use WithPagination, LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $aduan = ModelsPengaduan::latest()->paginate(15);
        return view('livewire.pengaduan', ['aduan' => $aduan])->extends('layouts.app');
    }

    public function delete($id)
    {
        $sql = ModelsPengaduan::where('id', $id)->first();

        if ($sql->dokumentasi) {
            Storage::disk('public')->delete('img/aduan/' . $sql->dokumentasi);
        }

        $sql->find($id)->delete();

        $this->alert('warning', 'Data berhasil dihapus!');
    }
}
