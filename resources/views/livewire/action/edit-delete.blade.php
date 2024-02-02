<div class="d-flex justify-content-start">
    @if (request()->routeIs('siswa'))
        <button wire:click="$emit('detail', {{ $data->id }})" data-toggle="modal" data-target="#modalRiwayat"
            class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></button>&nbsp;
    @endif
    <button wire:click="$emit('edit', {{ $data->id }})" class="btn btn-sm btn-info"><i
            class="fas fa-edit"></i></button>&nbsp;
    @if (Auth::user()->hasRole(['admin', 'waka', 'kesiswaan']))
        <button wire:click="$emit('delete', {{ $data->id }})" class="btn btn-sm btn-danger"
            onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                class="fas fa-trash"></i></button>
    @endif
</div>
