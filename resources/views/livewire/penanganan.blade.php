@section('title', 'Penanganan Siswa')
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
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" placeholder="Search" wire:model="searchTerm" />
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Guru BK</th>
                                    <th>Permasalahan</th>
                                    <th>Tindak Lanjut</th>
                                    <th>Hasil</th>
                                    <th>Pihak Terlibat</th>
                                    <th>Dokumentasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">Belum ada data</td>
                                    </tr>
                                @else
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($d->tanggal)) }}</td>
                                            <td>{{ $d->siswa->nama }}</td>
                                            <td>{{ $d->siswa->kelas->nama_kelas }}</td>
                                            <td>{{ $d->user->name }}</td>
                                            <td>{{ $d->permasalahan }}</td>
                                            <td>{{ $d->tindak_lanjut }}</td>
                                            <td>{{ $d->hasil }}</td>
                                            <td>{{ $d->pihak_terlibat }}</td>
                                            <td>
                                                @if ($d->dokumentasi != null)
                                                    <a href="{{ url('/storage/' . $d->dokumentasi) }}"
                                                        target="_blank"><button
                                                            class="btn btn-sm btn-info">Lihat</button></a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->hasRole('admin') || Auth::user()->id == $d->user_id)
                                                    <button wire:click="delete({{ $d->id }})"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                                                            class="fas fa-trash"></i></button>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
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
                    <h4 class="modal-title">Penanganan Siswa</h4>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store()" enctype="multipart/form-data">
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
                                <label for="siswa">Nama Siswa</label>
                                <select wire:model="siswa_id"
                                    class="form-control @error('siswa_id') is-invalid @enderror" id="siswa"
                                    required>
                                    <option value="">-- Pilih --</option>
                                    @if ($siswa_list)
                                        @foreach ($siswa_list as $siswa)
                                            <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if ($siswa_id)
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" wire:model="nis"
                                    class="form-control @error('nis') is-invalid @enderror" id="nis" disabled />
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
                                <label for="permasalahan">Permasalahan</label>
                                <textarea wire:model.lazy="permasalahan" class="form-control @error('permasalahan') is-invalid @enderror"
                                    id="permasalahan" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tl">Tindak Lanjut</label>
                                <textarea wire:model.lazy="tl" class="form-control @error('tl') is-invalid @enderror" id="tl" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil">Hasil</label>
                                <textarea wire:model.lazy="hasil" class="form-control @error('hasil') is-invalid @enderror" id="hasil"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pihakterlibat">Pihak Terlibat</label>
                                <textarea wire:model.lazy="pihakterlibat" class="form-control @error('pihakterlibat') is-invalid @enderror"
                                    id="pihakterlibat" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dokumentasi">Dokumentasi</label>
                                <input class="form-control" type="file" wire:model="dokumentasi"
                                    id="upload{{ $iteration }}">
                            </div>
                        @endif
                        @if ($showbtn)
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        @endif
                        <button type="button" wire:click="closeModal" class="btn btn-default"
                            data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener('closeModalTambah', event => {
            $("#modalTambah").modal('hide');
        })
    </script>
</div>
