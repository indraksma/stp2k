@section('title', 'Pengurangan Poin')
@section('titlebutton')
    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTambah"><i
            class="fas fa-plus"></i>&nbsp;Tambah
        Data</button>
@endsection
<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Keterangan</th>
                                    <th>Poin Pengurang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data</td>
                                    </tr>
                                @else
                                    @php $i = 1; @endphp
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                            <td>{{ $d->siswa->nama }}</td>
                                            <td>{{ $d->keterangan }}</td>
                                            <td>{{ $d->poin }}</td>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="col-sm-12 col-md-12">
                            <div class="dataTables_paginate paging_simple_numbers">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalTambah" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pengurangan Poin Siswa</h4>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" wire:model="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select wire:model="jurusan_id"
                                class="form-control @error('jurusan_id') is-invalid @enderror" id="jurusan" required>
                                <option value="">-- Pilih --</option>
                                @if ($jurusan_list)
                                    @foreach ($jurusan_list as $jrs)
                                        <option value="{{ $jrs->id }}">{{ $jrs->kode_jurusan }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @if ($jurusan_id)
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select wire:model="kelas_id"
                                    class="form-control @error('kelas_id') is-invalid @enderror" id="kelas"
                                    required>
                                    <option value="">-- Pilih --</option>
                                    @if ($kelas_list)
                                        @foreach ($kelas_list as $kls)
                                            <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if ($kelas_id)
                            <div class="form-group">
                                <label for="siswa">NIS</label>
                                <select wire:model="siswa_id"
                                    class="form-control @error('siswa_id') is-invalid @enderror" id="siswa"
                                    required>
                                    <option value="">-- Pilih --</option>
                                    @if ($siswa_list)
                                        @foreach ($siswa_list as $siswa)
                                            <option value="{{ $siswa->id }}">{{ $siswa->nis }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if ($siswa_id)
                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" wire:model="nama_siswa"
                                    class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <input type="text" wire:model="jk"
                                    class="form-control @error('jk') is-invalid @enderror" id="jk" disabled />
                            </div>
                            <div class="form-group">
                                <label for="poin_siswa">Poin Siswa</label>
                                <input type="text" wire:model="poin_siswa"
                                    class="form-control @error('poin_siswa') is-invalid @enderror" id="poin_siswa"
                                    disabled />
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea wire:model.lazy="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="poin">Poin Pengurangan</label>
                                <input type="number" wire:model="poin"
                                    class="form-control @error('poin') is-invalid @enderror" id="poin" />
                            </div>
                        @endif
                        @if ($showbtn)
                            <button type="submit" class="btn btn-primary">Simpan</button>&emsp;
                        @endif
                        <button type="button" wire:click="closeModal" class="btn btn-default"
                            data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
