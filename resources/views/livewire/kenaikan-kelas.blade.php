@section('title', 'Kenaikan Kelas')
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h6 class="card-title">Pengurangan Poin 50% (Kenaikan Kelas)</h6>
                    <p class="card-text">Dengan menekan tombol proses, Anda akan melakukan pengurangan poin sebesar 50%
                        dari poin yang dimiliki masing-masing siswa.</p>
                    <div class="alert alert-warning mb-3">
                        Setelah pengurangan berhasil diproses harap berhati-hati saat menghapus data pelanggaran siswa
                        karena dapat mengakibatkan hitungan poin siswa menjadi rusak / tidak jelas!
                    </div>
                    <button type="button" wire:click="proses()"
                        onclick="confirm('Apakah Anda sudah yakin?') || event.stopImmediatePropagation()"
                        class="btn btn-primary">Proses</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h6 class="card-title mb-2">Riwayat Pengurangan Poin (Kenaikan Kelas)</h6>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($riwayat->isNotEmpty())
                                @foreach ($riwayat as $r)
                                    <tr>
                                        <td>{{ $r->created_at }}</td>
                                        <td>{{ $r->user->name }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
