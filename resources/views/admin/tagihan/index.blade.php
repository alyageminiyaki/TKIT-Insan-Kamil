@extends('layouts.admin')

@section('title', 'Manajemen Tagihan')

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

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 8px;
    }

    .btn-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border: none;
        color: white;
        border-radius: 8px;
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

    .modal-header {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        color: white;
        border-radius: 10px 10px 0 0;
    }

    .modal-title {
        color: white;
        font-weight: 700;
    }

    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(14, 165, 233, 0.2);
    }

    .modal-body {
        color: #0c4a6e;
    }

    .modal-body strong {
        color: #075985;
    }

    .btn-default {
        background: #e2e8f0;
        color: #0c4a6e;
        border: none;
        border-radius: 10px;
    }

    .btn-default:hover {
        background: #cbd5e0;
    }

    .pagination>li>a,
    .pagination>li>span {
        color: #0ea5e9;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        margin: 0 3px;
    }

    .pagination>.active>a,
    .pagination>.active>span {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border-color: #0ea5e9;
        color: white;
    }

    .pagination>li>a:hover,
    .pagination>li>span:hover {
        background-color: #e0f2fe;
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

        .block-options {
            margin-top: 10px;
        }

        .block-options form {
            width: 100%;
            margin-bottom: 10px;
        }

        .block-options label {
            display: block;
            margin-bottom: 5px;
        }

        .block-options select {
            width: 100%;
        }

        .block-content {
            padding: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            padding: 10px 12px;
            font-size: 14px;
        }

        .btn-primary,
        .btn-success,
        .btn-info {
            padding: 8px 15px;
            font-size: 13px;
        }

        .table {
            font-size: 12px;
        }

        .table thead th {
            padding: 10px 8px;
            font-size: 12px;
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

        .btn-xs {
            padding: 4px 8px;
            font-size: 11px;
        }

        .modal-dialog {
            margin: 10px;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            padding: 15px;
        }

        .modal-body {
            padding: 15px;
        }

        .pagination {
            font-size: 12px;
        }

        .pagination>li>a,
        .pagination>li>span {
            padding: 6px 10px;
            margin: 0 2px;
        }
    }
</style>
@endpush

@section('content')
{{-- Header Halaman --}}
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-money"></i>Manajemen Tagihan Infaq<br><small>Generate dan lihat status tagihan</small>
        </h1>
    </div>
</div>

{{-- Isi Halaman --}}
<div class="content">
    @if (session('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><i class="fa fa-check-circle"></i> Sukses!</strong> {{ session('success') }}
    </div>
    @endif

    {{-- Block untuk Generate Tagihan --}}
    <div class="block animation-fadeInQuick">
        {{-- ... (Kode Form Generate Tagihan tidak berubah) ... --}}
        <div class="block-title">
            <h2><strong><i class="fa fa-cogs"></i> Generate Tagihan Bulanan</strong></h2>
        </div>
        <form action="{{ route('admin.tagihan.store') }}" method="POST" class="form-horizontal form-bordered">
            @csrf
            <div class="form-group">
                <label class="col-md-3 control-label" for="nominal">Nominal Tagihan</label>
                <div class="col-md-6">
                    <input type="number" id="nominal" name="nominal" class="form-control @error('nominal') input-error @enderror" placeholder="Masukkan jumlah infaq (contoh: 150000)" required min="0" value="{{ old('nominal', 150000) }}">
                    @error('nominal') <span class="help-block text-danger">{{$message}}</span> @enderror
                    <span class="help-block">Masukkan nominal infaq untuk bulan ini.</span>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-9 col-md-offset-3">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-cog"></i> Generate Tagihan Bulan Ini ({{ date('F Y') }})</button>
                    <span class="help-block">Sistem akan otomatis membuat tagihan untuk semua siswa aktif & mencegah duplikasi.</span>
                </div>
            </div>
        </form>
    </div>

    {{-- Block untuk Daftar Tagihan --}}
    <div class="block animation-fadeInQuick" data-animation-delay="200">
        <div class="block-title">
            {{-- Filter dan Export --}}
            <div class="block-options pull-right form-inline">
                {{-- Form Filter Tahun dan Status --}}
                <form action="{{ route('admin.tagihan.index') }}" method="GET" style="display: inline-block; margin-right: 10px;">
                    {{-- Filter Status --}}
                    <label for="status" class="hidden-xs">Status: </label>
                    <select name="status" id="status" class="form-control input-sm" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach($daftarStatus as $key => $value)
                        <option value="{{ $key }}" {{ $key == $statusDipilih ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <h2><strong><i class="fa fa-table"></i> Daftar Tagihan Tahun {{ $tahunDipilih }} {{ $statusDipilih ? '('.$daftarStatus[$statusDipilih].')' : '' }}</strong></h2>
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
                            <th class="text-center" style="width: 10%;">Bukti Bayar</th>
                            <th class="text-center" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihan as $item)
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
                                @elseif($item->status == 'ditolak')
                                <span class="label label-danger">Ditolak</span>
                                @else
                                <span class="label label-danger">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->pembayaran)
                                <button type="button" data-toggle="modal" data-target="#lihatBukti{{ $item->id }}" class="btn btn-xs btn-info" title="Lihat Bukti">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @else
                                -
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->status == 'menunggu_verifikasi')
                                <form action="{{ route('admin.tagihan.verifikasi', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin verifikasi pembayaran ini?');" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-success" title="Verifikasi Pembayaran">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.tagihan.tolak', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menolak pembayaran ini?');" style="display:inline-block; margin-left: 5px;">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-danger" title="Tolak Pembayaran">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Tidak ada data tagihan ditemukan untuk filter yang dipilih.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{-- PERBAIKAN: Tambahkan appends untuk kedua filter --}}
                {{ $tagihan->appends(['tahun' => $tahunDipilih, 'status' => $statusDipilih])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Modal Lihat Bukti (Tidak Berubah) --}}
@push('modal')
@foreach ($tagihan as $item)
@if ($item->pembayaran)
<div class="modal fade" id="lihatBukti{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    {{-- ... isi modal lihat bukti ... --}}
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Bukti Pembayaran: {{ $item->siswa->nama_siswa ?? 'Siswa Dihapus' }}</h5>
            </div>
            <div class="modal-body text-center">
                <p><strong>Periode:</strong> {{ \Carbon\Carbon::create()->month((int)$item->bulan)->format('F') }} {{ $item->tahun }}</p>
                <img src="{{ asset('storage/' . $item->pembayaran->struk_bukti) }}" alt="Bukti Pembayaran" class="img-responsive center-block" style="max-height: 400px; display: inline-block;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach
@endpush