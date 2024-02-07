<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KodePelanggaran;

class KpTable extends Component
{
    use WithPagination;

    protected $listeners = ['refreshKpTable' => '$refresh'];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $kp = KodePelanggaran::orderBy('kode_pelanggaran', 'ASC')->orderBy('jenis_pelanggaran_id', 'ASC')->paginate(10);
        return view('livewire.setting.kp-table',  ['kp' => $kp]);
    }
}
