@section('title', 'Home')
<div>
    <div class="login-logo">
        <img src="{{ asset('skansa.png') }}" width="75px" /><br />
        <small>Sistem Informasi Poin Pelanggaran SMKN 1 Bawang</small>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <div class="row">
                <div class="col-12">
                    @if (!$showcek)
                        <button wire:click="ceksiswa" class="btn btn-primary btn-block"><i class="fas fa-user-check"></i>
                            Cek Poin
                            Siswa</button>
                        <button class="btn btn-warning btn-block"><i class="fas fa-flag"></i>
                            Pengaduan</button>
                        <button class="btn btn-success btn-block"><i class="fas fa-file-download"></i>
                            Tata
                            Tertib</button>
                        <button class="btn btn-info btn-block"><i class="fas fa-file-download"></i>
                            Ketentuan
                            Poin</button>
                    @endif
                    @if ($showcek)
                        <div class="form-group mt-2">
                            <input type="number" min="6" class="form-control" placeholder="Masukkan NIS"
                                wire:model="nis" />
                        </div>
                        <button type="button" wire:click="cekpoin" data-toggle="modal" data-target="#modalRiwayat"
                            class="btn btn-primary btn-block">Cek
                            Poin</button>
                        <button type="button" wire:click="home" class="btn btn-secondary btn-block">Kembali</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Riwayat --}}
    <div wire:ignore.self class="modal fade" id="modalRiwayat" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Detail Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($siswa_id)
                        <livewire:detail-siswa :idsiswa="$siswa_id" :wire:key="$siswa_id" />
                    @else
                        <h4 class="modal-title mb-3 bg-warning text-center">NIS Tidak Ditemukan</h4>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Pengaduan --}}
    <div wire:ignore.self class="modal fade" id="modalPengaduan" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Pengaduan Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
