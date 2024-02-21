<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Poin Pelanggaran PKL SMKN 1 Bawang">
    <meta name="author" content="IndraKus @indrakus_">
    <link rel="icon" type="image" href="{{ asset('favicon.png') }}">
    <title>Riwayat Poin Siswa - SIPOIN</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        .coba td {
            padding-top: 7px;
            padding-bottom: 7px;
            padding-left: 5px;
            padding-right: 5px;
        }

        .topik td {
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            font-size: 10px;
            text-align: left;
            vertical-align: top;
        }

        .ctr {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3 class="ctr">DAFTAR RIWAYAT PELANGGARAN SISWA<br>SMK NEGERI 1 BAWANG</h3>
    <h4 class="ctr">Update : {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y, H:mm:ss') }}</h4>
    <table style="margin-bottom: 20px;">
        <tr>
            <td width="150px">Nama Siswa</td>
            <td width="10px">:</td>
            <td>{{ $siswa->nama }}</td>
        </tr>
        <tr>
            <td width="150px">Kelas</td>
            <td width="10px">:</td>
            <td>{{ $siswa->kelas->nama_kelas }}</td>
        </tr>
        <tr>
            <td width="150px">NIS</td>
            <td width="10px">:</td>
            <td>{{ $siswa->nis }}</td>
        </tr>
        <tr style="font-weight: bold;">
            <td width="150px">Total Poin</td>
            <td width="10px">:</td>
            <td>{{ $siswa->poin_siswa }}</td>
        </tr>
    </table>
    <h4 style="font-weight: bold">Riwayat Pelanggaran</h4>
    <table border="1" class="coba ctr" width="100%" cellspacing="0" style="margin-bottom: 50px;">
        <tr style="font-weight: bold;">
            <td width="10%">No.</td>
            <td width="20%">Tanggal</td>
            <td width="50%">Pelanggaran</td>
            <td width="20%">Poin</td>
        </tr>
        <?php
        $no = 1;
        ?>
        @if ($riwayat->isEmpty())
            <tr>
                <td class="ctr" colspan="4">Tidak Ada Data</td>
            </tr>
        @else
            @foreach ($riwayat as $key => $data)
                <tr>
                    <td class="ctr">{{ $no }}</td>
                    <td>{{ date('d-m-Y', strtotime($data->tanggal)) }}</td>
                    <td>{{ $data->kode_pelanggaran->nama_pelanggaran }}</td>
                    <td>{{ $data->poin }}</td>
                </tr>
                <?php
                $no++;
                ?>
            @endforeach
        @endif
    </table>
    @if ($pengurangan->isNotEmpty())
        <h4 style="font-weight: bold">Riwayat Pengurangan Poin</h4>
        <table border="1" class="coba ctr" width="100%" cellspacing="0" style="margin-bottom: 50px;">
            <tr style="font-weight: bold;">
                <td width="10%">No.</td>
                <td width="20%">Tanggal</td>
                <td width="50%">Keterangan</td>
                <td width="20%">Poin Pengurang</td>
            </tr>
            <?php
            $nos = 1;
            ?>
            @foreach ($pengurangan as $key => $datas)
                <tr>
                    <td class="ctr">{{ $no }}</td>
                    <td>{{ date('d-m-Y', strtotime($datas->tanggal)) }}</td>
                    <td>{{ $datas->keterangan }}</td>
                    <td>{{ $datas->poin }}</td>
                </tr>
                <?php
                $nos++;
                ?>
            @endforeach
        </table>
    @endif
</body>

</html>
