<?php

namespace App\Http\Livewire\Setting;

use App\Models\JenisPelanggaran;
use Livewire\Component;
use Livewire\WithPagination;

class JpTable extends Component
{
    use WithPagination;

    protected $listeners = ['refreshJpTable' => '$refresh'];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $jp = JenisPelanggaran::paginate(10);
        return view('livewire.setting.jp-table', ['jp' => $jp]);
    }
}
