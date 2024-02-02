@section('title', 'Edit Pelanggaran Siswa')
<div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <form wire:submit.prevent="store()" method="POST">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" wire:model="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" wire:model="jurusan"
                                class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" disabled />
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" wire:model="kelas"
                                class="form-control @error('kelas') is-invalid @enderror" id="kelas" disabled />
                        </div>
                        <div class="form-group">
                            <label for="siswa">NIS</label>
                            <input type="text" wire:model="nis"
                                class="form-control @error('nis') is-invalid @enderror" id="siswa" disabled />
                        </div>
                        <div class="form-group">
                            <label for="nama_siswa">Nama Siswa</label>
                            <input type="text" wire:model="nama_siswa"
                                class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa"
                                disabled />
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <input type="text" wire:model="jk" class="form-control @error('jk') is-invalid @enderror"
                                id="jk" disabled />
                        </div>
                        <div class="form-group">
                            <label for="poin_siswa">Poin Siswa</label>
                            <input type="text" wire:model="poin_siswa"
                                class="form-control @error('poin_siswa') is-invalid @enderror" id="poin_siswa"
                                disabled />
                        </div>
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
                        @if ($jp_id)
                            <div class="form-group">
                                <label for="kodepelanggaran">Kode Pelanggaran</label>
                                <select wire:model="kp_id" class="form-control @error('kp_id') is-invalid @enderror"
                                    id="kodepelanggaran" required>
                                    <option value="">-- Pilih --</option>
                                    @if ($kp_list)
                                        @foreach ($kp_list as $kpdata)
                                            <option value="{{ $kpdata->id }}">{{ $kpdata->nama_pelanggaran }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if ($poin)
                            <div class="form-group">
                                <label for="poin">Poin Pelanggaran</label>
                                <input type="text" wire:model="poin"
                                    class="form-control @error('poin') is-invalid @enderror" id="poin" disabled />
                            </div>
                        @endif
                        @if ($showbtn)
                            <button type="submit" class="btn btn-primary">Simpan</button>&emsp;
                        @endif
                        <a href="{{ route('datapelanggaran') }}"><button type="button"
                                class="btn btn-success">Kembali</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
