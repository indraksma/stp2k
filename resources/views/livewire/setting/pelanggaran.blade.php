@section('title', 'Pelanggaran')
<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <h5>Jenis Pelanggaran</h5>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-success btn-sm" wire:click="createModalJP"
                                data-toggle="modal" data-target="#createModalJP">Tambah</button>
                        </div>
                    </div>
                    <livewire:setting.jp-table />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <h5>Kode Pelanggaran</h5>
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="btn btn-success btn-sm" wire:click="createModalKP"
                                data-toggle="modal" data-target="#createModalKP">Tambah</button>
                        </div>
                    </div>
                    <livewire:setting.kp-table />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Jenis Pelanggaran -->
    <div wire:ignore.self class="modal fade" id="createModalJP" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah / Ubah Jenis Pelanggaran</h4>
                    <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="storeJP()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenispelanggaran">Jenis Pelanggaran</label>
                            <input type="text" wire:model.lazy="jenis_pelanggaran"
                                class="form-control @error('jenis_pelanggaran') is-invalid @enderror"
                                id="jenispelanggaran" placeholder="Jenis Pelanggaran">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:click="closeModal" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="storeJP()" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Kode Pelanggaran -->
    <div wire:ignore.self class="modal fade" id="createModalKP" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah / Ubah Kode Pelanggaran</h4>
                    <button type="button" class="close" wire:click="closeModal" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" wire:submit.prevent="storeKP()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="jenpelanggaran">Jenis Pelanggaran</label>
                            <select wire:model="jp_id" class="form-control @error('jp_id') is-invalid @enderror"
                                id="jenlanggaran" required>
                                <option value="">-- Pilih --</option>
                                @if ($jp_list)
                                    @foreach ($jp_list as $jpdata)
                                        <option value="{{ $jpdata->id }}">{{ $jpdata->jenis_pelanggaran }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kodepelanggaran">Kode Pelanggaran</label>
                            <input type="text" wire:model.lazy="kode_pelanggaran"
                                class="form-control @error('kode_pelanggaran') is-invalid @enderror"
                                id="kodepelanggaran" placeholder="Kode Pelanggaran">
                        </div>
                        <div class="form-group">
                            <label for="namapelanggaran">Nama Pelanggaran</label>
                            <input type="text" wire:model.lazy="nama_pelanggaran"
                                class="form-control @error('nama_pelanggaran') is-invalid @enderror"
                                id="namapelanggaran" placeholder="Nama Pelanggaran">
                        </div>
                        <div class="form-group">
                            <label for="poinpelanggaran">Poin</label>
                            <input type="number" wire:model.lazy="poin"
                                class="form-control @error('poin') is-invalid @enderror" id="poinpelanggaran"
                                placeholder="Poin">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" wire:click="closeModal" class="btn btn-default"
                            data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="storeKP()" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('storedData', event => {
            $('#createModalJP').modal('hide');
            $('#createModalKP').modal('hide');
        })
    </script>
</div>
