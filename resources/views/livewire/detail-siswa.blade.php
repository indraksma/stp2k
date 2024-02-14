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
                <b>Total Poin Siswa</b> <a class="float-right">
                    <h4 class="p-0 m-0"><span class="badge badge-warning">{{ $riwayatsiswa->poin_siswa }}</span></h4>
                </a>
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
                            <td>{{ $rp->kode_pelanggaran->nama_pelanggaran }}</td>
                            <td><span class="badge badge-warning">{{ $rp->poin }}</span></td>
                        </tr>
                        @php $nor++; @endphp
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="bg-secondary">Belum Ada Riwayat Poin</td>
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
    @if ($riwayatkurang && $riwayatkurang->isNotEmpty())
        <h4 class="modal-title mb-3 bg-warning text-center mt-2">Riwayat Pengurangan Poin</h4>
        <div class="table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Poin Pengurang</th>
                    </tr>
                </thead>
                <tbody>
                    @php $nox = 1; @endphp
                    @foreach ($riwayatkurang as $rk)
                        <tr>
                            <td>{{ $nox }}</td>
                            <td>{{ date('d-m-Y', strtotime($rk->tanggal)) }}</td>
                            <td>{{ $rk->keterangan }}</td>
                            <td><span class="badge badge-secondary">{{ $rk->poin }}</span></td>
                        </tr>
                        @php $nox++; @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="col-sm-12 col-md-12">
                <div class="dataTables_paginate paging_simple_numbers">
                    {{ $riwayatkurang->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
