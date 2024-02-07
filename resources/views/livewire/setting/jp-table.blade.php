<div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered mb-2">
            <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>Jenis Pelanggaran</th>
                    <th style="min-width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($jp as $jenispel)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $jenispel->jenis_pelanggaran }}</td>
                        <td>
                            <button type="button" wire:click="$emit('editModalJP', {{ $jenispel->id }})"
                                data-toggle="modal" data-target="#createModalJP" class="btn btn-warning btn-sm"><i
                                    class="fas fa-pen"></i></button>
                            &nbsp;
                            <button type="button" class="btn btn-danger btn-sm"
                                wire:click="$emit('deleteId', {{ $jenispel->id }}, 1)" data-toggle="modal"
                                data-target="#deleteModal"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        @if ($jp->isNotEmpty())
            <div class="col-sm-12 col-md-12">
                <div class="dataTables_paginate paging_simple_numbers">
                    {{ $jp->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
