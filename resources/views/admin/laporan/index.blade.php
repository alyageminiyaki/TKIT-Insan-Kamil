@extends('layouts.admin')

@section('title', 'Laporan Tagihan')

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

    .content-header h1 small {
        color: #0c4a6e;
        font-size: 14px;
        display: block;
        margin-top: 8px;
        font-weight: 400;
    }

    .content-header .gi-charts {
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

    .btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
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

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 10px;
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

    .pagination>li>a,
    .pagination>li>span {
        color: #0ea5e9;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        margin: 0 3px;
    }

    .pagination>.active>a {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border-color: #0ea5e9;
        color: white;
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

        .content-header h1 small {
            font-size: 12px;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group .col-md-1,
        .form-group .col-md-2,
        .form-group .col-md-4 {
            width: 100%;
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
        }

        .table {
            font-size: 12px;
        }

        .table thead th {
            padding: 10px 8px;
            font-size: 11px;
        }

        .table tbody td {
            padding: 10px 8px;
            font-size: 12px;
        }

        .label-success,
        .label-warning,
        .label-danger {
            padding: 4px 8px;
            font-size: 11px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .pagination {
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
{{-- Header Halaman --}}
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-charts"></i>Laporan Tagihan Infaq<br><small>Lihat dan filter data tagihan</small>
        </h1>
    </div>
</div>

{{-- Isi Halaman --}}
<div class="content">
    {{-- Block untuk Filter --}}
    <div class="block animation-fadeInQuick">
        <div class="block-title">
            <h2><strong><i class="fa fa-filter"></i> Filter Laporan</strong></h2>
        </div>
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="form-horizontal form-bordered">
            <div class="form-group">
                {{-- Filter Tanggal --}}
                <label class="col-md-1 control-label" for="tanggal_mulai">Tanggal</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" value="{{ $tanggalMulai }}">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <label class="col-md-1 control-label text-center" for="tanggal_selesai">s/d</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" value="{{ $tanggalSelesai }}">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{-- Filter Status --}}
                <label class="col-md-1 control-label" for="status">Status</label>
                <div class="col-md-4">
                    <select name="status" id="status" class="form-control">
                        <option value="">Semua Status</option>
                        @foreach($daftarStatus as $key => $value)
                        <option value="{{ $key }}" {{ $key == $status ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </div>
                {{-- Tombol Submit --}}
                <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-search"></i> Tampilkan</button>
                    <a href="{{ route('admin.laporan.export', ['tanggal_mulai' => $tanggalMulai, 'tanggal_selesai' => $tanggalSelesai, 'status' => $status]) }}"
                        class="btn btn-sm btn-success"
                        data-toggle="tooltip"
                        title="Download Laporan Excel Sesuai Filter">
                        <i class="fa fa-download"></i> Export Excel
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- Block untuk Hasil Laporan --}}
    <div class="block animation-fadeInQuick" data-animation-delay="200">
        <div class="block-title">
            <h2><strong><i class="fa fa-table"></i> Hasil Laporan</strong></h2>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-vcenter table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Bulan/Tahun</th>
                            <th>Nama Siswa</th>
                            <th>Wali Murid</th>
                            <th class="text-right" style="width: 15%;">Nominal</th>
                            <th class="text-center" style="width: 15%;">Status</th>
                            <th class="text-center" style="width: 15%;">Tgl. Bayar</th> {{-- Tampilkan tanggal bayar --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporanTagihan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month((int)$item->bulan)->format('F') }} {{ $item->tahun }}</td>
                            <td>{{ $item->siswa->nama_siswa ?? 'Siswa Dihapus' }}</td>
                            <td>{{ $item->siswa->user->name ?? 'Wali Dihapus' }}</td>
                            <td class="text-right">Rp{{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($item->status == 'lunas')
                                <span class="label label-success">Lunas</span>
                                @elseif($item->status == 'menunggu_verifikasi')
                                <span class="label label-warning">Menunggu Verifikasi</span>
                                @else
                                <span class="label label-danger">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $item->pembayaran ? \Carbon\Carbon::parse($item->pembayaran->tanggal_transfer)->format('d-m-Y') : '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Tidak ada data tagihan ditemukan untuk filter yang dipilih.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{-- Pagination dengan filter --}}
                {{ $laporanTagihan->appends($request->except('page'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection