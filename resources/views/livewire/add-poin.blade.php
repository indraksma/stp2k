@section('title', 'Tambah Pelanggaran Siswa')
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
                            <select wire:model="jurusan_id"
                                class="form-control @error('jurusan_id') is-invalid @enderror" id="jurusan" required>
                                <option value="">-- Pilih --</option>
                                @if ($jurusan_list)
                                    @foreach ($jurusan_list as $jrs)
                                        <option value="{{ $jrs->id }}">{{ $jrs->kode_jurusan }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @if ($jurusan_id)
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select wire:model="kelas_id"
                                    class="form-control @error('kelas_id') is-invalid @enderror" id="kelas"
                                    required>
                                    <option value="">-- Pilih --</option>
                                    @if ($kelas_list)
                                        @foreach ($kelas_list as $kls)
                                            <option value="{{ $kls->id }}">{{ $kls->nama_kelas }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if ($kelas_id)
                            <div class="form-group">
                                <label for="siswa">Nama Siswa</label>
                                <select wire:model="siswa_id"
                                    class="form-control @error('siswa_id') is-invalid @enderror" id="siswa"
                                    required>
                                    <option value="">-- Pilih --</option>
                                    @if ($siswa_list)
                                        @foreach ($siswa_list as $siswa)
                                            <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if ($siswa_id)
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" wire:model="nis"
                                    class="form-control @error('nis') is-invalid @enderror" id="nis" disabled />
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <input type="text" wire:model="jk"
                                    class="form-control @error('jk') is-invalid @enderror" id="jk" disabled />
                            </div>
                            <div class="form-group">
                                <label for="poin_siswa">Poin Siswa</label>
                                <input type="text" wire:model="poin_siswa"
                                    class="form-control @error('poin_siswa') is-invalid @enderror" id="poin_siswa"
                                    disabled />
                            </div>
                        @endif
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
                        @if ($alert_pernah)
                            <div class="alert alert-danger">Siswa tersebut sudah tercatat melakukan pelanggaran
                                tersebut hari ini!</div>
                        @endif
                        @if ($poin)
                            <div class="form-group">
                                <label for="poin">Poin Pelanggaran</label>
                                <input type="text" wire:model="poin"
                                    class="form-control @error('poin') is-invalid @enderror" id="poin" disabled />
                            </div>
                            <div class="alert alert-warning">
                                <input type="checkbox" wire:model="check" id="checklist">
                                <label for="checklist">Validasi</label>
                                <p>Pastikan siswa sudah menyadari atas pelanggaran yg sudah dilakukan. Tunjukan poin ini
                                    kepada siswa, jika perlu siswa yg mencentang Validasi.</p>
                            </div>
                        @endif
                        @if ($showbtn)
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        @endif
                        <a href="{{ route('datapelanggaran') }}"><button type="button"
                                class="btn btn-success">Kembali</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
