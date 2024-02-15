@section('title', 'Kelas')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">Data Kelas</h3>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Tahun Angkatan</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $item)
                            <tr>
                                <td>{{ $item->nama_kelas }}</td>
                                <td>{{ $item->jurusan->nama_jurusan }}</td>
                                <td>{{ $item->tahun_ajaran->tahun_ajaran }}</td>
                                <td>
                                    <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info"><i
                                            class="fas fa-edit"></i></button>
                                    <button wire:click="delete({{ $item->id }})" class="btn btn-sm btn-danger"
                                        onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                                            class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm-12 col-md-12">
                    <div class="dataTables_paginate paging_simple_numbers">
                        {{ $kelas->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah / Ubah Data</h4>
            </div>
            <form method="POST" wire:submit.prevent="store()">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input wire:model.lazy="nama_kelas" id="nama_kelas" type="text" name="nama_kelas"
                            value="{{ old('nama_kelas') }}"
                            class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="Nama Kelas"
                            required="required">
                    </div>
                    @error('nama_kelas')
                        <div class="alert alert-danger">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <select wire:model="jurusan_id" id="jurusan_id" type="text" name="jurusan_id"
                            value="{{ old('jurusan_id') }}"
                            class="form-control @error('jurusan_id') is-invalid @enderror" required="required">
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($jurusan as $jrs)
                                <option value="{{ $jrs->id }}">{{ $jrs->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('jurusan_id')
                        <div class="alert alert-danger">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <select wire:model="tahun_ajaran_id" id="tahun_ajaran_id" type="text" name="tahun_ajaran_id"
                            value="{{ old('tahun_ajaran_id') }}"
                            class="form-control @error('tahun_ajaran_id') is-invalid @enderror" required="required">
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach ($tahun_ajaran as $ta)
                                <option value="{{ $ta->id }}">{{ $ta->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('tahun_ajaran_id')
                        <div class="alert alert-danger">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <button type="button" wire:click="resetForm()" class="btn btn-warning">Reset</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
                    <hr />
                    <h5>Import Data</h5>
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <div class="custom-file">
                                <input class="form-control" type="file" wire:model="template_excel"
                                    id="upload{{ $iteration }}">
                            </div>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-info" wire:click="import">Import</button>
                            </div>
                        </div>
                        <a href="{{ asset('format_import_kelas.xlsx') }}">Download format import</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
