<div class="d-flex justify-content-start">
    @if (Auth::user()->hasRole(['admin','waka','pokja']))
    <button wire:click="$emit('edit', {{ $data->id }})" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>&nbsp;
    <button wire:click="$emit('delete', {{ $data->id }})" class="btn btn-sm btn-danger" onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i class="fas fa-trash"></i></button>
    @else
    -
    @endif
</div>