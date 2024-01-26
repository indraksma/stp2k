@section('title', 'User')
@if ($isOpen)
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data User</h4>
            <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="POST" wire:submit.prevent="store()">
            <div class="card-body">
                <div class="input-group mb-3">
                    <input wire:model.lazy="name" id="name" type="text" name="name"
                        value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Full Name" required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('name')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <div class="input-group mb-3">
                    <input wire:model.lazy="nip" id="nip" type="text" name="nip"
                        value="{{ old('nip') }}" class="form-control @error('nip') is-invalid @enderror"
                        placeholder="NIP" required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-barcode"></span>
                        </div>
                    </div>
                </div>
                @error('nip')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <div class="input-group mb-3">
                    <input wire:model.lazy="identity" id="identity" type="text" name="identity"
                        value="{{ old('identity') }}" class="form-control @error('identity') is-invalid @enderror"
                        placeholder="Identity" required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                @error('identity')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <div class="input-group mb-3">
                    <input wire:model.lazy="email" id="email" type="email" name="email"
                        value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email" required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <div class="input-group mb-3">
                    <input wire:model.lazy="password" id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                        required="required">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
                <div class="input-group mb-3">
                    <select wire:model="roles" id="roles" name="roles"
                        class="form-control @error('roles') is-invalid @enderror" required="required">
                        <option value="">-- Pilih --</option>
                        @foreach ($role as $roles)
                            <option value="{{ $roles->id }}">{{ Str::upper($roles->name) }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-users-cog"></span>
                        </div>
                    </div>
                </div>
                @error('roles')
                    <div class="alert alert-danger">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" wire:click="closeModal()" class="btn btn-default">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@else
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Data User</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <button type="button" class="btn btn-success" wire:click="create()">Tambah</button>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input class="form-control" type="file" wire:model="template_excel"
                                            id="upload{{ $iteration }}">
                                    </div>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-info"
                                            wire:click="import">Import</button>
                                    </div>
                                </div>
                                <a href="{{ asset('format_import_user.xlsx') }}">Download format import</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Identity</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="width: 200px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $users)
                            <tr>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->nip }}</td>
                                <td>{{ $users->identity }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ Str::upper($users->getRoleNames()->first()) }}</td>
                                <td>
                                    <button wire:click="edit({{ $users->id }})" class="btn btn-sm btn-info"><i
                                            class="fas fa-edit"></i></button>
                                    <button wire:click="delete({{ $users->id }})" class="btn btn-sm btn-danger"
                                        onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()"><i
                                            class="fas fa-trash"></i></button>
                                    <?php
                                    $userlogin = auth()->user();
                                    if ($userlogin->hasRole('admin')) {
                                        $exodus = date('YwmldFn');
                                        $secret = '20mmIx' . $exodus . 'uXciG4JH';
                                        $method = 'AES-128-ECB';
                                        $sid = 'ahsdydwqiueo328764892sdqye8aq2kjkh';
                                        $arr = [
                                            'session' => $sid,
                                            'identity' => $users->identity,
                                            'identitas' => $users->identity,
                                            'email' => $users->email,
                                            'name' => $users->name,
                                            'nimda' => 's4ns4nes14',
                                            'var' => 'admin_login',
                                            'value' => 'yes',
                                        ];
                                        $service = 'http://jurnalpkl.smkn1bawang.sch.id/ssoout';
                                        $str = urlencode(serialize($arr));
                                        //$str = obfuscate("ENC", $str, $secret);
                                        $str = openssl_encrypt($str, $method, $secret);
                                        //echo $str;
                                        $linklog = "$service?$str";
                                    } ?>
                                    <a href="{{ $linklog }}"><button
                                            class="btn btn-sm btn-primary">Login</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm-12 col-md-12">
                    <div class="dataTables_paginate paging_simple_numbers">
                        {{ $user->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endif
