@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('skansa.png') }}" width="150px" /><br />
            <small>Sistem Informasi Poin Pelanggaran</small>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                @if (session('message'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    <div class="d-none">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('ssocek') }}" class="btn btn-primary btn-block">Login dengan SSO</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
