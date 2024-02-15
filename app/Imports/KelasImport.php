<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KelasImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $ta = TahunAjaran::where('tahun_ajaran', 'LIKE', $row[1])->first();
        $jrs = Jurusan::where('kode_jurusan', 'LIKE', $row[2])->first();
        return new Kelas([
            'nama_kelas' => $row[0],
            'jurusan_id' => $jrs->id,
            'tahun_ajaran_id' => $ta->id,
        ]);
    }
}
