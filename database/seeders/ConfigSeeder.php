<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahunAjaran::create([
            'tahun_ajaran'      => '2023 / 2024',
            'aktif'      => 1,
        ]);
        TahunAjaran::create([
            'tahun_ajaran'      => '2024 / 2025',
            'aktif'      => 0,
        ]);
        TahunAjaran::create([
            'tahun_ajaran'      => '2025 / 2026',
            'aktif'      => 0,
        ]);

        Jurusan::create([
            'kode_jurusan'  => 'PPLG',
            'nama_jurusan'  => 'Pemrograman Perangkat Lunak dan Gim',
        ]);
        Jurusan::create([
            'kode_jurusan'  => 'TJKT',
            'nama_jurusan'  => 'Teknik Jaringan Komputer dan Telekomunikasi',
        ]);
        Jurusan::create([
            'kode_jurusan'  => 'TE',
            'nama_jurusan'  => 'Teknik Elektronika',
        ]);
        Jurusan::create([
            'kode_jurusan'  => 'AKL',
            'nama_jurusan'  => 'Akuntansi dan Keuangan Lembaga',
        ]);
        Jurusan::create([
            'kode_jurusan'  => 'PM',
            'nama_jurusan'  => 'Pemasaran',
        ]);
        Jurusan::create([
            'kode_jurusan'  => 'FS',
            'nama_jurusan'  => 'Busana / Fashion',
        ]);
        Jurusan::create([
            'kode_jurusan'  => 'AP',
            'nama_jurusan'  => 'Agribisnis Perikanan',
        ]);
        Jurusan::create([
            'kode_jurusan'  => 'MPLB',
            'nama_jurusan'  => 'Manajemen Perkantoran dan Layanan Bisnis',
        ]);
    }
}
