@section('title', 'Data Pelanggaran')
@section('titlebutton')
    <a href="{{ route('addpoin') }}"><button class="btn btn-primary btn-block"><i class="fas fa-plus"></i>&nbsp;Tambah
            Pelanggaran</button></a>
@endsection
<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <livewire:pelanggaran-table />
                </div>
            </div>
        </div>
    </div>
</div>
