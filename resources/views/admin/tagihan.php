@extends('layouts.admin')

@section('title', 'Manajemen Tagihan')

@push('css-custom')
<style>
    /* Tema Biru Muda - Konsisten dengan Login/Register */
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

    /* Block Styling */
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

    /* Form Styling */
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

    /* Button Styling */
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

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-primary i {
        margin-right: 8px;
    }

    /* Table Styling */
    .table-responsive {
        border-radius: 10px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead {
        background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
    }

    .table thead th {
        color: #075985;
        font-weight: 700;
        border-bottom: 2px solid #0ea5e9;
        padding: 15px;
        font-size: 14px;
    }

    .table tbody tr {
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f0f9ff;
        transform: scale(1.01);
    }

    .table tbody td {
        padding: 15px;
        color: #0c4a6e;
        border-bottom: 1px solid #e2e8f0;
        vertical-align: middle;
    }

    /* Label Status */
    .label {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
    }

    .label-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }

    .label-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }

    .label-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }

    /* Alert Styling */
    .alert {
        border-radius: 10px;
        border: none;
        padding: 15px 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-success strong {
        color: #065f46;
    }

    /* HR Styling */
    hr {
        border: none;
        border-top: 2px solid #e2e8f0;
        margin: 25px 0;
    }

    /* Pagination Styling */
    .pagination {
        margin-top: 25px;
    }

    .pagination>li>a,
    .pagination>li>span {
        color: #0ea5e9;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        margin: 0 3px;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .pagination>li>a:hover,
    .pagination>li>span:hover {
        background: #f0f9ff;
        border-color: #0ea5e9;
        color: #0284c7;
    }

    .pagination>.active>a,
    .pagination>.active>span {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border-color: #0ea5e9;
        color: white;
    }

    /* Empty State */
    .table tbody tr td.text-center {
        color: #0c4a6e;
        padding: 40px;
        font-style: italic;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .content-header {
            padding: 20px;
        }

        .block-content {
            padding: 15px;
        }

        .table thead th,
        .table tbody td {
            padding: 10px;
            font-size: 13px;
        }
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-money"></i>Manajemen Tagihan Infaq
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
            <h2><strong>Generate & Daftar Tagihan</strong></h2>
        </div>

        <div class="block-content">
            {{-- Form untuk tombol Generate --}}
            <form action="{{ route('admin.tagihan.store') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="fa fa-cog"></i> Generate Tagihan Bulan Ini ({{ date('F Y') }})
                        </button>
                        <p class="help-block">Klik tombol ini untuk membuat tagihan bulan ini secara otomatis untuk semua siswa yang aktif. Sistem akan mencegah duplikasi data.</p>
                    </div>
                </div>
            </form>
            <hr>

            {{-- Tabel untuk menampilkan daftar tagihan --}}
            <div class="table-responsive">
                <table class="table table-vcenter table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Bulan/Tahun</th>
                            <th>Nama Siswa</th>
                            <th>Wali Murid</th>
                            <th>Nominal</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tagihan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::create()->month($item->bulan)->format('F') }} {{ $item->tahun }}</td>
                            <td>{{ $item->siswa->nama_siswa }}</td>
                            <td>{{ $item->siswa->user->name }}</td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($item->status == 'lunas')
                                <span class="label label-success">Lunas</span>
                                @elseif($item->status == 'menunggu_verifikasi')
                                <span class="label label-warning">Menunggu Verifikasi</span>
                                @else
                                <span class="label label-danger">Belum Lunas</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data tagihan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $tagihan->links() }}
            </div>
        </div>
    </div>
</div>
@endsection