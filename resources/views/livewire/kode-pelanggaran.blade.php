@section('title', 'Kode Pelanggaran')
<div>
    <div class="row">
        @php $i = 0; @endphp
        @foreach ($jp as $data)
            <div class="col-12">
                <div class="card card-primary collapsed-card">
                    <div class="card-header" data-card-widget="collapse">
                        <h3 class="card-title">{{ $data->jenis_pelanggaran }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: none;">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-2">
                                <thead>
                                    <tr>
                                        <th style="width: 15%">Kode</th>
                                        <th style="width: 65%">Pelanggaran</th>
                                        <th style="width: 20%">Poin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($kp)
                                        @foreach ($kp[$data->id] as $kodepel[$i])
                                            <tr>
                                                <td>{{ $kodepel[$i]->kode_pelanggaran }}</td>
                                                <td>{{ $kodepel[$i]->nama_pelanggaran }}</td>
                                                <td>{{ $kodepel[$i]->poin }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @php $i++; @endphp
        @endforeach
    </div>
</div>
