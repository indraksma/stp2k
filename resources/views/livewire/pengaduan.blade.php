@section('title', 'Pengaduan Siswa')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Topik</th>
                                    <th>Aduan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($aduan->isNotEmpty())
                                    @foreach ($aduan as $data)
                                        <tr>
                                            <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->topik }}</td>
                                            <td>{{ $data->aduan }}</td>
                                            <td>
                                                @if ($data->dokumentasi)
                                                    <a href="{{ asset('storage/img/aduan/' . $data->dokumentasi) }}"
                                                        target="_blank"><button type="button" class="btn btn-sm btn-info"
                                                            data-placement="top" data-toggle="tooltip"
                                                            title="Dokumentasi"><i class="fas fa-eye"></i></button></a>
                                                @endif
                                                <button wire:click="delete({{ $data->id }})"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Belum Ada Aduan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="col-sm-12 col-md-12">
                            <div class="dataTables_paginate paging_simple_numbers">
                                {{ $aduan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {

                $('[data-toggle="tooltip"]').tooltip();

                if (typeof window.Livewire !== 'undefined') {
                    window.Livewire.hook('message.processed', (message, component) => {
                        $('[data-toggle="tooltip"]').tooltip('dispose').tooltip();
                    });
                }

            });
        </script>
    @endpush
</div>
