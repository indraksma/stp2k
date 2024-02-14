<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Pelanggaran;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Illuminate\Database\Eloquent\Builder;

class PelanggaranTable extends DataTableComponent
{
    protected $model = Pelanggaran::class;
    protected $listeners = ['refreshPelanggaranTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['pelanggarans.id', 'pelanggarans.user_id']);
        $this->setDefaultSort('tanggal', 'desc');
    }

    public function filters(): array
    {
        return [
            DateFilter::make('Tanggal')->filter(function (Builder $builder, string $value) {
                $builder->where('tanggal', $value);
            }),
        ];
    }

    public function columns(): array
    {
        if (Auth::user()->hasRole(['admin', 'kesiswaan'])) {
            return [
                Column::make("Tanggal", "tanggal")
                    ->format(
                        fn ($value, $row, Column $column) => date('d-m-Y', strtotime($row->tanggal))
                    )
                    ->searchable(function (Builder $query, $searchTerm) {
                        if (date_parse($searchTerm)) {
                            $tanggal = date('Y-m-d', strtotime($searchTerm));
                        } else {
                            $tanggal = $searchTerm;
                        }
                        $query->orWhere('tanggal', 'like', $tanggal);
                    })
                    ->sortable(),
                Column::make("Nama Siswa", "siswa.nama")
                    ->searchable()
                    ->sortable(),
                Column::make("NIS", "siswa.nis")
                    ->searchable()
                    ->sortable(),
                Column::make("Kelas", "siswa.kelas.nama_kelas")
                    ->searchable()
                    ->sortable(),
                Column::make("Nama Pelanggaran", "kode_pelanggaran.nama_pelanggaran")
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
                    ->searchable(function (Builder $query, $searchTerm) {
                        if (date_parse($searchTerm)) {
                            $tanggal = date('Y-m-d', strtotime($searchTerm));
                        } else {
                            $tanggal = $searchTerm;
                        }
                        $query->orWhere('tanggal', 'like', $tanggal);
                    })
                    ->sortable(),
                Column::make("Nama Siswa", "siswa.nama")
                    ->searchable()
                    ->sortable(),
                Column::make("NIS", "siswa.nis")
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
