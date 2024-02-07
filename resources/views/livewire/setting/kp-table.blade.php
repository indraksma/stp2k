<div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered mb-2">
            <thead>
                <tr>
                    <th style="width: 10px">Kode</th>
                    <th>Jenis</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th style="min-width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kp as $kodepel)
                    <tr>
                        <td>{{ $kodepel->kode_pelanggaran }}</td>
                        <td>{{ $kodepel->jenis_pelanggaran->jenis_pelanggaran }}</td>
                        <td>{{ $kodepel->nama_pelanggaran }}</td>
                        <td>{{ $kodepel->poin }}</td>
                        <td>
                            <button type="button" wire:click="$emit('editModalKP', {{ $kodepel->id }})"
                                data-toggle="modal" data-target="#createModalKP" class="btn btn-warning btn-sm"><i
                                    class="fas fa-pen"></i></button>
                            &nbsp;
                            <button type="button" class="btn btn-danger btn-sm"
                                wire:click="$emit('deleteId', {{ $kodepel->id }}, 2)" data-toggle="modal"
                                data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($kp->isNotEmpty())
            <div class="col-sm-12 col-md-12">
                <div class="dataTables_paginate paging_simple_numbers">
                    {{ $kp->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
