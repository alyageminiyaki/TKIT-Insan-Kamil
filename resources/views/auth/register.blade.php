@extends('layouts.auth')
@section('content')
<div class="block animation-fadeInQuick">
    <div class="block-title">
        <h2>Create Account</h2>
    </div>
    <form id="form-register" action="{{ route('register') }}" method="post" class="form-horizontal">
        @csrf
        <div class="form-group">
            <div class="col-xs-12">
                <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required autofocus>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        {{-- PERUBAHAN DI SINI: TAMBAH INPUT USERNAME --}}
        <div class="form-group">
            <div class="col-xs-12">
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                @error('username') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input type="email" id="email" name="email" class="form-control" placeholder="Your Email (Optional)" value="{{ old('email') }}">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <input type="password" id="password-confirmation" name="password_confirmation" class="form-control" placeholder="Verify Password" required>
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-xs-6">
                <a href="{{ route('login') }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back to Login</a>
            </div>
            <div class="col-xs-6 text-right">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Register Account</button>
            </div>
        </div>
    </form>
</div>
@endsection