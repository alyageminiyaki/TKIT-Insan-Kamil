@extends('layouts.admin')

@section('title', 'Tambah Siswa Baru')

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

    .card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.1);
        border: none;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        padding: 20px 25px;
        border-bottom: none;
    }

    .card-title {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 20px;
    }

    .card-body {
        padding: 25px;
    }

    .form-label {
        color: #075985;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0ea5e9;
        background: white;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        outline: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
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

    .btn-secondary {
        background: #e2e8f0;
        color: #0c4a6e;
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 13px;
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

        .card {
            margin: 0 10px;
        }

        .card-header {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-body {
            padding: 20px;
        }

        .form-label {
            font-size: 13px;
        }

        .form-control,
        .form-select {
            padding: 10px 12px;
            font-size: 14px;
        }

        .btn-primary,
        .btn-secondary {
            padding: 10px 20px;
            font-size: 14px;
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-user-plus"></i>Tambah Siswa Baru
        </h1>
    </div>
</div>

<div class="content">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Tambah Siswa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.siswa.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" value="{{ old('nama_siswa') }}">
                    @error('nama_siswa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" id="nis" value="{{ old('nis') }}">
                    @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas" value="{{ old('kelas') }}">
                    @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="user_id" class="form-label">Pilih Wali Murid</label>
                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                        <option value="">-- Pilih Wali Murid --</option>
                        @foreach ($waliMurid as $wali)
                        <option value="{{ $wali->id }}">{{ $wali->name }} - {{ $wali->email }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.siswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
    @endsection