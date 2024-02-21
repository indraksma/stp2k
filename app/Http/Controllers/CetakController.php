<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pelanggaran;
use App\Models\PenguranganPoin;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CetakController extends Controller
{
    public function kelas($id)
    {
        $siswa = Siswa::where('kelas_id', $id)->get();
        $kelas = Kelas::where('id', $id)->first();

        $pdf = PDF::loadView('print.kelas', ['siswa' => $siswa, 'kelas' => $kelas]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Daftar-Poin-' . $kelas->nama_kelas . '.pdf');
    }

    public function siswa($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $riwayat = Pelanggaran::where('siswa_id', $id)->get();
        $pengurangan = PenguranganPoin::where('siswa_id', $id)->get();

        $pdf = PDF::loadView('print.siswa', ['siswa' => $siswa, 'riwayat' => $riwayat, 'pengurangan' => $pengurangan]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Daftar-Poin-' . $siswa->nama . '.pdf');
    }
}
