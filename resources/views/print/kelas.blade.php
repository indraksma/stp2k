<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Informasi Poin Pelanggaran PKL SMKN 1 Bawang">
    <meta name="author" content="IndraKus @indrakus_">
    <link rel="icon" type="image" href="{{ asset('favicon.png') }}">
    <title>Riwayat Poin Kelas - SIPOIN</title>
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
    <h3 class="ctr">DAFTAR TOTAL POIN SISWA<br>SMK NEGERI 1 BAWANG</h3>
    <h4 class="ctr">KELAS {{ $kelas->nama_kelas }}</h4>
    <h4 class="ctr">Update : {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y, H:mm:ss') }}</h4>
    <table border="1" class="coba ctr" width="100%" cellspacing="0" style="margin-bottom: 50px;">
        <tr style="font-weight: bold;">
            <td width="10%">No.</td>
            <td width="50%">Nama</td>
            <td width="20%">NIS</td>
            <td width="20%">Total Poin</td>
        </tr>
        <?php
        $no = 1;
        ?>
        @foreach ($siswa as $key => $data)
            <tr>
                <td class="ctr">{{ $no }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->nis }}</td>
                <td>{{ $data->poin_siswa }}</td>
            </tr>
            <?php
            $no++;
            ?>
        @endforeach
    </table>
</body>

</html>
