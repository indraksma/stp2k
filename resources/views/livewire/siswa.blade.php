@section('title', 'Siswa')
<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-0">Data Siswa</h3>
                </div>
                @if (Auth::user()->hasRole('admin'))
                    <div class="col-md-6 text-right">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <button type="button" class="btn btn-success" wire:click="create()">Tambah</button>&nbsp;
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input class="form-control" type="file" wire:model="template_excel"
                                                id="upload{{ $iteration }}">
                                        </div>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-info"
                                                wire:click="import">Import</button>
                                        </div>
                                    </div>
                                    <a href="{{ asset('format_import_siswa.xlsx') }}">Download format import</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="form-control" wire:model="jurusan_id">
                            <option value="">-- Pilih --</option>
                            @foreach ($jurusan_list as $jrs)
                                <option value="{{ $jrs->id }}">{{ $jrs->kode_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" wire:model="kelas_id">
                            <option value="">-- Pilih --</option>
                            @if ($kelas_list)
                                @foreach ($kelas_list as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    @if ($showtable)
                        <livewire:tabel-siswa :wire:key="$kelas_id" :id="$kelas_id" />
                    @endif
                    {{-- <livewire:siswa-table /> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Siswa --}}
    <div class="modal fade @if ($openModal) show @endif" id="modal-default"
        style="@if ($openModal) display: block; @endif" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Siswa</h4>
                    <button type="button" wire:click="closeModal" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="store()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="namaSiswa">Nama</label>
                            <input type="text" wire:model.lazy="nama"
                                class="form-control @error('nama') is-invalid @enderror" id="namaSiswa"
                                placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group">
                            <label for="tempatLahir">Tempat Lahir</label>
                            <input type="text" wire:model.lazy="tempat_lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempatLahir"
                                placeholder="Tempat Lahir">
                        </div>
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir</label>
                            <input type="date" wire:model.lazy="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggalLahir"
                                placeholder="Tanggal Lahir">
                        </div>
                        <div class="form-group">
                            <label for="namaSiswa">NIS</label>
                            <input type="text" wire:model.lazy="nis"
                                class="form-control @error('nis') is-invalid @enderror" id="nisSiswa"
                                placeholder="Nomor Induk Siswa">
                        </div>
                        <div class="form-group">
                            <label for="jkSiswa">JK</label>
                            <select type="text" wire:model="jk"
                                class="form-control @error('jk') is-invalid @enderror" id="jkSiswa">
                                <option value="">-- Jenis Kelamin --</option>
                                <option value="L">Laki - Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelasSiswa">Kelas</label>
                            <select type="text" wire:model="kelas_id"
                                class="form-control @error('kelas_id') is-invalid @enderror" id="kelasSiswa">
                                <option value="">-- Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:click="closeModal" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>
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
