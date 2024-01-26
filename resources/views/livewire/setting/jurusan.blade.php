@section('title', 'Jurusan')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">Data Jurusan</h3>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jur as $item)
                            <tr>
                                <td>{{ $item->kode_jurusan }}</td>
                                <td>{{ $item->nama_jurusan }}</td>
                                <td>
                                    <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info"><i
                                            class="fas fa-edit"></i></button>&nbsp;
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
                        {{ $jur->links() }}
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
                        <input wire:model.lazy="kode_jurusan" id="kode_jurusan" type="text" name="kode_jurusan"
                            value="{{ old('kode_jurusan') }}"
                            class="form-control @error('kode_jurusan') is-invalid @enderror" placeholder="Kode Jurusan"
                            required="required">
                    </div>
                    @error('kode_jurusan')
                        <div class="alert alert-danger">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input wire:model.lazy="nama_jurusan" id="nama_jurusan" type="text" name="nama_jurusan"
                            value="{{ old('nama_jurusan') }}"
                            class="form-control @error('nama_jurusan') is-invalid @enderror" placeholder="Nama Jurusan"
                            required="required">
                    </div>
                    @error('nama_jurusan')
                        <div class="alert alert-danger">
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" wire:click="resetForm()" class="btn btn-warning">Reset</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
