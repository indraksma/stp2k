@section('title', 'Tahun Angkatan')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h3 class="card-title">Data Tahun Angkatan</h3>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tahun Angkatan</th>
                            <th>Status</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ta as $item)
                            <tr>
                                <td>{{ $item->tahun_ajaran }}</td>
                                <td>
                                    @if ($item->aktif == 0)
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                    @else
                                        <span class="badge badge-primary">Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->aktif == 0)
                                        <button wire:click="activate({{ $item->id }})"
                                            class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>&nbsp;
                                    @elseif ($item->aktif == 1)
                                        <button wire:click="deactivate({{ $item->id }})"
                                            class="btn btn-sm btn-secondary"><i class="fas fa-times"></i></button>&nbsp;
                                    @endif
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
                        {{ $ta->links() }}
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
                        <input wire:model.lazy="tahun_ajaran" id="tahun_ajaran" type="text" name="tahun_ajaran"
                            value="{{ old('tahun_ajaran') }}"
                            class="form-control @error('tahun_ajaran') is-invalid @enderror"
                            placeholder="Tahun Angkatan" required="required">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-calendar"></span>
                            </div>
                        </div>
                    </div>
                    @error('tahun_ajaran')
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
