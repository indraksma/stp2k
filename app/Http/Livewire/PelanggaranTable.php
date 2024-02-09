<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pelanggaran;
use Illuminate\Support\Facades\Auth;

class PelanggaranTable extends DataTableComponent
{
    protected $model = Pelanggaran::class;
    protected $listeners = ['refreshPelanggaranTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['pelanggarans.id']);
        $this->setDefaultSort('tanggal', 'desc');
    }

    public function columns(): array
    {
        if (Auth::user()->hasRole(['admin', 'kesiswaan'])) {
            return [
                Column::make("Tanggal", "tanggal")
                    ->format(
                        fn ($value, $row, Column $column) => date('d-m-Y', strtotime($row->tanggal))
                    )
                    ->searchable()
                    ->sortable(),
                Column::make("Nama Siswa", "siswa.nama")
                    ->searchable()
                    ->sortable(),
                Column::make("Kelas", "siswa.kelas.nama_kelas")
                    ->searchable()
                    ->sortable(),
                Column::make("Jenis Pelanggaran", "kode_pelanggaran.jenis_pelanggaran.jenis_pelanggaran")
                    ->searchable()
                    ->sortable(),
                Column::make("Kode Pelanggaran", "kode_pelanggaran.kode_pelanggaran")
                    ->searchable()
                    ->sortable(),
                Column::make("Poin", "poin")
                    ->searchable()
                    ->sortable(),
                Column::make("Petugas", "user.name")
                    ->searchable()
                    ->sortable(),
                Column::make('Actions')
                    ->label(function ($row, Column $column) {
                        return view('livewire.action.edit-delete', ['data' => $row]);
                    }),
            ];
        } else {
            return [
                Column::make("Tanggal", "tanggal")
                    ->format(
                        fn ($value, $row, Column $column) => date('d-m-Y', strtotime($row->tanggal))
                    )
                    ->searchable()
                    ->sortable(),
                Column::make("Nama Siswa", "siswa.nama")
                    ->searchable()
                    ->sortable(),
                Column::make("Kelas", "siswa.kelas.nama_kelas")
                    ->searchable()
                    ->sortable(),
                Column::make("Jenis Pelanggaran", "kode_pelanggaran.jenis_pelanggaran.jenis_pelanggaran")
                    ->searchable()
                    ->sortable(),
                Column::make("Kode Pelanggaran", "kode_pelanggaran.kode_pelanggaran")
                    ->searchable()
                    ->sortable(),
                Column::make("Poin", "poin")
                    ->searchable()
                    ->sortable(),
                Column::make('Actions')
                    ->label(function ($row, Column $column) {
                        return view('livewire.action.edit-delete', ['data' => $row]);
                    }),
            ];
        }
    }
}
