@section('title', 'Dashboard')
@section('titlebutton')
    <a href="#"><button class="btn btn-primary btn-block"><i class="fas fa-plus"></i>&nbsp;Tambah
            Pelanggaran</button></a>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5>10 Pelanggaran Terakhir</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-2">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Kode Pelanggaran</th>
                                    <th>Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-warning">
                                    <td>1.</td>
                                    <td>25/01/2024</td>
                                    <td>Muhammad Fariz</td>
                                    <td>2024 TE 1</td>
                                    <td>Kedisiplinan</td>
                                    <td>B1a</td>
                                    <td><span class="badge bg-secondary">2</span></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>25/01/2024</td>
                                    <td>Arifin</td>
                                    <td>2024 TE 1</td>
                                    <td>Kedisiplinan</td>
                                    <td>B1b</td>
                                    <td><span class="badge bg-secondary">2</span></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>25/01/2024</td>
                                    <td>Yoyon</td>
                                    <td>2024 TE 2</td>
                                    <td>Kelakukan</td>
                                    <td>C2</td>
                                    <td><span class="badge bg-secondary">5</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <span class="badge bg-warning">Siswa Memiliki Poin Lebih dari 50</span>
                    <span class="badge bg-danger">Siswa Memiliki Poin Lebih dari 100</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-danger card-outline">
                <div class="card-body">
                    <h5>10 Siswa dengan Poin Tertinggi</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-2">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Poin Pelanggaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Muhammad Fariz</td>
                                    <td>2024 TE 1</td>
                                    <td>
                                        <h4><span class="badge bg-warning">50</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Arifin</td>
                                    <td>2024 TE 1</td>
                                    <td>
                                        <h4><span class="badge bg-warning">25</span></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Yoyon</td>
                                    <td>2024 TE 2</td>
                                    <td>
                                        <h4><span class="badge bg-warning">15</span></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
