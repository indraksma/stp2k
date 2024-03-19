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
                                    <th>Aksi</th>
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
                                            <td><button wire:click="detail({{ $datar->siswa_id }})" data-toggle="modal"
                                                    data-target="#modalRiwayat" class="btn btn-sm btn-primary"><i
                                                        class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        @php $no++; @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Belum Ada Data</td>
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
                                    <th>Aksi</th>
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
                                                <h4>
                                                    <span class="badge bg-warning">{{ $datas->poin_siswa }}</span>
                                                    @if ($datas->poin_siswa % 25 == 0 || $datas->poin_siswa >= 25)
                                                        @php
                                                            $jp = $datas->penanganan->count();
                                                            $mod = floor($datas->poin_siswa / 25);
                                                        @endphp
                                                        &nbsp;|&nbsp;
                                                        @for ($x = 1; $x <= $mod; $x++)
                                                            @if ($x == $jp)
                                                                <span class="badge bg-success"
                                                                    style="font-size: 11pt;">{{ $x }}</span>
                                                            @else
                                                                <span class="badge bg-secondary"
                                                                    style="font-size: 11pt;">{{ $x }}</span>
                                                            @endif
                                                        @endfor
                                                    @endif
                                                </h4>
                                            </td>
                                            <td><button wire:click="detail({{ $datas->id }})" data-toggle="modal"
                                                    data-target="#modalRiwayat" class="btn btn-sm btn-primary"><i
                                                        class="fas fa-eye"></i></button>
                                            </td>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        Keterangan Penanganan Siswa :
                        <ul class="mb-0">
                            <li>
                                1 / 2 / 3 / 4 : Jumlah Poin Siswa Sudah Perlu dilakukan Penanganan ke-1 / 2 / 3 / 4 oleh
                                BK
                            </li>
                            <li>
                                <span class="badge bg-secondary">1</span> : Belum Ditangani BK
                            </li>
                            <li>
                                <span class="badge bg-success">1</span> : Sudah Ditangani BK
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Riwayat --}}
    <div wire:ignore.self class="modal fade" id="modalRiwayat" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Detail Siswa</h4>
                    <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($siswa_id)
                        <livewire:detail-siswa :idsiswa="$siswa_id">
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="closeModal" class="btn btn-default"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
