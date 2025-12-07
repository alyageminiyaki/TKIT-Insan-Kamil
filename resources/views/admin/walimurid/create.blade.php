@extends('layouts.admin')

@section('title', 'Tambah Wali Murid')

@push('css-custom')
<style>
    /* Tema Biru Muda - Konsisten dengan Login/Register/Tagihan */
    .content-header {
        background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.2);
    }

    .content-header h1 {
        color: #075985;
        font-weight: 700;
        margin: 0;
    }

    .content-header .fa-user-plus {
        color: #0ea5e9;
        margin-right: 10px;
    }

    .block {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.1);
        border: none;
        margin-bottom: 25px;
        overflow: hidden;
    }

    .block-title {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        padding: 20px 25px;
        border-bottom: none;
    }

    .block-title h2 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 20px;
    }

    .block-title h2 strong {
        color: white;
    }

    .block-content {
        padding: 25px;
    }

    .form-group label {
        color: #075985;
        font-weight: 600;
        font-size: 14px;
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .form-control:focus {
        border-color: #0ea5e9;
        background: white;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        outline: none;
    }

    .help-block {
        color: #0c4a6e;
        font-size: 13px;
        margin-top: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
    }

    .btn-default {
        background: #e2e8f0;
        color: #0c4a6e;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
    }

    .btn-default:hover {
        background: #cbd5e0;
    }

    /* Responsive untuk Mobile */
    @media (max-width: 768px) {
        .content-header {
            padding: 20px 15px;
            margin-bottom: 20px;
        }

        .content-header h1 {
            font-size: 20px;
        }

        .block-title {
            padding: 15px;
        }

        .block-title h2 {
            font-size: 16px;
        }

        .block-content {
            padding: 15px;
        }

        .form-group .col-md-3,
        .form-group .col-md-6,
        .form-group .col-md-9 {
            width: 100%;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
        }

        .form-actions .col-md-9 {
            width: 100%;
        }

        .btn-primary,
        .btn-default {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
@endpush

@section('content')
{{-- Header Halaman --}}
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-user-plus"></i>Tambah Akun Wali Murid Baru
        </h1>
    </div>
</div>

{{-- Isi Halaman --}}
<div class="content">
    <div class="block">
        <div class="block-title">
            <h2><strong>Formulir Wali Murid</strong></h2>
        </div>
        {{-- Form --}}
        <form action="{{ route('admin.walimurid.store') }}" method="POST" class="form-horizontal form-bordered">
            @csrf
            {{-- Nama Lengkap --}}
            <div class="form-group @error('name') has-error @enderror">
                <label class="col-md-3 control-label" for="name">Nama Lengkap</label>
                <div class="col-md-6">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama lengkap wali murid" value="{{ old('name') }}" required>
                    @error('name') <span class="help-block text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Username --}}
            <div class="form-group @error('username') has-error @enderror">
                <label class="col-md-3 control-label" for="username">Username</label>
                <div class="col-md-6">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Buat username unik untuk login" value="{{ old('username') }}" required>
                    @error('username') <span class="help-block text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Password --}}
            <div class="form-group @error('password') has-error @enderror">
                <label class="col-md-3 control-label" for="password">Password</label>
                <div class="col-md-6">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password default" required>
                    @error('password') <span class="help-block text-danger">{{ $message }}</span> @enderror
                    <span class="help-block">Minimal 1 karakter.</span>
                </div>
            </div>

            {{-- Konfirmasi Password --}}
            <div class="form-group">
                <label class="col-md-3 control-label" for="password_confirmation">Konfirmasi Password</label>
                <div class="col-md-6">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ketik ulang password" required>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="form-group form-actions">
                <div class="col-md-9 col-md-offset-3">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan Wali Murid</button>
                    <a href="{{ route('admin.walimurid.index') }}" class="btn btn-sm btn-default">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection