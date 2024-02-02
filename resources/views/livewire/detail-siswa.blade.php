<div>
    @if ($riwayatsiswa)
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Nama Siswa</b> <a class="float-right">{{ $riwayatsiswa->nama }}</a>
            </li>
            <li class="list-group-item">
                <b>Program Keahlian</b> <a class="float-right">{{ $riwayatsiswa->kelas->jurusan->kode_jurusan }}</a>
            </li>
            <li class="list-group-item">
                <b>Kelas</b> <a class="float-right">{{ $riwayatsiswa->kelas->nama_kelas }}</a>
            </li>
            <li class="list-group-item">
                <b>NIS</b> <a class="float-right">{{ $riwayatsiswa->nis }}</a>
            </li>
            <li class="list-group-item">
                <b>Jenis Kelamin</b> <a class="float-right">{{ $riwayatsiswa->jk }}</a>
            </li>
            <li class="list-group-item">
                <b>Tempat Lahir</b> <a
                    class="float-right">{{ $riwayatsiswa->tempat_lahir ? $riwayatsiswa->tempat_lahir : '-' }}</a>
            </li>
            <li class="list-group-item">
                <b>Tanggal Lahir</b> <a
                    class="float-right">{{ $riwayatsiswa->tanggal_lahir ? $riwayatsiswa->tanggal_lahir : '-' }}</a>
            </li>
        </ul>
    @endif
    <h4 class="modal-title mb-3 bg-info text-center">Riwayat Poin</h4>
    <div class="table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Kode Pelanggaran</th>
                    <th>Detail Pelanggaran</th>
                    <th>Poin</th>
                </tr>
            </thead>
            <tbody>
                @if ($riwayatpoin && $riwayatpoin->isNotEmpty())
                    @php $nor = 1; @endphp
                    @foreach ($riwayatpoin as $rp)
                        <tr>
                            <td>{{ $nor }}</td>
                            <td>{{ date('d-m-Y', strtotime($rp->tanggal)) }}</td>
                            <td>{{ $rp->kode_pelanggaran->jenis_pelanggaran->jenis_pelanggaran }}</td>
                            <td>{{ $rp->kode_pelanggaran->kode_pelanggaran }}</td>
                            <td>{{ $rp->kode_pelanggaran->nama_pelanggaran }}</td>
                            <td><span class="badge badge-warning">{{ $rp->poin }}</span></td>
                        </tr>
                        @php $nor++; @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="bg-secondary">Belum Ada Riwayat Poin</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="col-sm-12 col-md-12">
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $riwayatpoin->links() }}
            </div>
        </div>
    </div>
</div>
