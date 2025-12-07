@extends('layouts.walimurid')

@section('title', 'Tagihan Saya')

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

    .content-header .gi-money {
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

    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 12px;
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

    .btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        transform: translateY(-2px);
    }

    .btn-default {
        background: #e2e8f0;
        color: #0c4a6e;
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
    }

    .btn-default:hover {
        background: #cbd5e0;
    }

    .table thead {
        background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
    }

    .table thead th {
        color: #075985;
        font-weight: 700;
        border-bottom: 2px solid #0ea5e9;
        padding: 15px;
    }

    .table tbody tr:hover {
        background-color: #f0f9ff;
    }

    .table tbody td {
        color: #0c4a6e;
        border-bottom: 1px solid #e2e8f0;
    }

    .label-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .label-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .label-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
        border-radius: 10px;
    }

    /* Responsive untuk Mobile */
    @media (max-width: 768px) {
        .content-header {
            padding: 20px 15px;
            margin-bottom: 20px;
        }

        .content-header h1 {
            font-size: 18px;
        }

        .block-title {
            padding: 15px;
        }

        .block-title h2 {
            font-size: 16px;
        }

        .block-options {
            margin-top: 10px;
            width: 100%;
        }

        .block-options form {
            width: 100%;
            margin-bottom: 10px;
        }

        .block-options label {
            display: block;
            margin-bottom: 5px;
            font-size: 12px;
        }

        .block-options select {
            width: 100%;
        }

        .block-content {
            padding: 15px;
        }

        .table {
            font-size: 11px;
        }

        .table thead th {
            padding: 8px 5px;
            font-size: 11px;
        }

        .table tbody td {
            padding: 8px 5px;
            font-size: 11px;
        }

        .label-success,
        .label-warning,
        .label-danger {
            padding: 4px 8px;
            font-size: 10px;
        }

        .btn-xs {
            padding: 4px 8px;
            font-size: 10px;
        }

        .btn-primary,
        .btn-default {
            font-size: 11px;
        }
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-money"></i>Rekap Tagihan Infaq Anak{{ $statusDipilih && isset($daftarStatus[$statusDipilih]) ? ' - ' . $daftarStatus[$statusDipilih] : '' }}
        </h1>
    </div>
</div>

<div class="content">
    @if (session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Sukses!</strong> {{ session('success') }}
    </div>
    @endif

    <div class="block">
        <div class="block-title">
            {{-- Filter Status --}}
            <div class="block-options pull-right form-inline">
                <form action="{{ route('walimurid.tagihan.index') }}" method="GET">
                    <label for="status">Filter Status: </label>
                    <select name="status" id="status" class="form-control input-sm" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach($daftarStatus as $key => $value)
                        <option value="{{ $key }}" {{ $key == $statusDipilih ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            <h2><strong>Daftar Tagihan{{ $statusDipilih && isset($daftarStatus[$statusDipilih]) ? ' - ' . $daftarStatus[$statusDipilih] : '' }}</strong></h2>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-vcenter table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Bulan/Tahun</th>
                            <th>Nama Siswa</th>
                            <th>Nominal</th>
                            {{-- PERBAIKAN: Kolom dipisah kembali --}}
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month((int)$item->bulan)->format('F') }} {{ $item->tahun }}</td>
                            <td>{{ $item->siswa->nama_siswa }}</td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>

                            {{-- PERBAIKAN: Kolom Status (Hanya Label) --}}
                            <td class="text-center" style="width: 20%;">
                                @if($item->status == 'lunas')
                                <span class="label label-success">Lunas</span>
                                @elseif($item->status == 'menunggu_verifikasi')
                                <span class="label label-warning">Menunggu Verifikasi</span>
                                @elseif($item->status == 'ditolak')
                                <span class="label label-danger">Ditolak</span>
                                @else
                                <span class="label label-danger">Belum Lunas</span>
                                @endif
                            </td>

                            {{-- PERBAIKAN: Kolom Aksi (Hanya Tombol) --}}
                            <td class="text-center" style="width: 20%;">
                                @if($item->status == 'lunas')
                                <a href="{{ route('walimurid.tagihan.kuitansi', $item->id) }}" class="btn btn-xs btn-default" target="_blank">
                                    <i class="fa fa-download"></i> Kuitansi
                                </a>
                                @elseif($item->status == 'belum_lunas' || $item->status == 'ditolak')
                                <a href="{{ route('walimurid.tagihan.show', $item->id) }}" class="btn btn-xs btn-primary">
                                    <i class="fa fa-upload"></i> {{ $item->status == 'ditolak' ? 'Upload Ulang' : 'Bayar Sekarang' }}
                                </a>
                                @else
                                {{-- Tidak ada aksi jika menunggu verifikasi --}}
                                -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            {{-- PERBAIKAN: Colspan disesuaikan menjadi 5 --}}
                            <td colspan="5" class="text-center">Belum ada data tagihan{{ $statusDipilih && isset($daftarStatus[$statusDipilih]) ? ' dengan status ' . $daftarStatus[$statusDipilih] : '' }}.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Tidak perlu pagination --}}
        </div>
    </div>
</div>
@endsection