<div>
    <hr>
    <div class="row">
        <div class="col-12">
            <input type="text" class="form-control mb-2" placeholder="Search" wire:model="searchTerm" />
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>JK</th>
                            <th>Kelas</th>
                            <th>Total Poin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($siswa && $siswa->isNotEmpty())
                            @foreach ($siswa as $data)
                                <tr>
                                    <td>{{ $data->nis }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->jk }}</td>
                                    <td>{{ $data->nama_kelas }}</td>
                                    <td>
                                        <h4 class="p-0 m-0"><span
                                                class="badge badge-warning">{{ $data->poin_siswa }}</span>
                                        </h4>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <button wire:click="$emit('detail', {{ $data->id }})"
                                                data-toggle="modal" data-target="#modalRiwayat"
                                                class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>&nbsp;
                                            <button wire:click="$emit('edit', {{ $data->id }})"
                                                class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>&nbsp;
                                            @if (Auth::user()->hasRole(['admin', 'waka', 'kesiswaan']))
                                                <button wire:click="$emit('delete', {{ $data->id }})"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                                                        class="fas fa-trash"></i></button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="bg-secondary">Belum Ada Siswa</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="col-sm-12 col-md-12">
                    <div class="dataTables_paginate paging_simple_numbers">
                        {{ $siswa->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
