@section('title', 'Dashboard')
@section('titlebutton')
    <a href="{{ route('addpoin') }}"><button class="btn btn-primary btn-block"><i class="fas fa-plus"></i>&nbsp;Tambah
            Pelanggaran</button></a>
@endsection
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5>Pelanggaran Hari ini</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-2">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Nama Pelanggaran</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($riwayat->isNotEmpty())
                                    @php $no = 1; @endphp
                                    @foreach ($riwayat as $datar)
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ date('d-m-Y', strtotime($datar->tanggal)) }}</td>
                                            <td>{{ $datar->siswa->nama }}</td>
                                            <td>{{ $datar->siswa->kelas->nama_kelas }}</td>
                                            <td>{{ $datar->kode_pelanggaran->nama_pelanggaran }}</td>
                                            <td><span class="badge bg-secondary">{{ $datar->poin }}</span></td>
                                        </tr>
                                        @php $no++; @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Belum Ada Data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- <span class="badge bg-warning">Siswa Memiliki Poin Lebih dari 50</span>
                    <span class="badge bg-danger">Siswa Memiliki Poin Lebih dari 100</span> --}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-danger card-outline">
                <div class="card-body">
                    <h5>10 Siswa dengan Poin Tertinggi</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-2">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Poin Pelanggaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($siswa)
                                    @php $i = 1; @endphp
                                    @foreach ($siswa as $datas)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $datas->nama }}</td>
                                            <td>{{ $datas->nama_kelas }}</td>
                                            <td>
                                                <h4><span class="badge bg-warning">{{ $datas->poin_siswa }}</span></h4>
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
