@extends('layouts.admin')

@section('title', 'Manajemen Wali Murid')

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

    .content-header .fa-user-friends {
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

    .btn-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border: none;
        color: white;
        border-radius: 8px;
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
        border-radius: 10px;
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

        .block-content {
            padding: 15px;
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

        .btn-xs {
            padding: 4px 8px;
            font-size: 11px;
        }

        .pagination {
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-user-friends"></i>Manajemen Wali Murid<br><small>Lihat dan Crud Wali Murid</small>
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
            <div class="block-options pull-right">
                {{-- Tombol Tambah --}}
                <a href="{{ route('admin.walimurid.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah Wali Murid
                </a>
            </div>
            <h2><strong>Daftar Wali Murid</strong></h2>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-vcenter table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-center" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($waliMurid as $wali)
                        <tr>
                            <th class="text-center">{{ $loop->iteration + ($waliMurid->currentPage() - 1) * $waliMurid->perPage() }}</th>
                            <td>{{ $wali->name }}</td>
                            <td>{{ $wali->username }}</td>
                            <td>{{ $wali->created_at->format('d M Y H:i') }}</td>
                            <td class="text-center">
                                {{-- Tombol Edit & Hapus (implementasi nanti) --}}
                                {{-- Arahkan ke route edit --}}
                                <a href="{{ route('admin.walimurid.edit', $wali->id) }}" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-pencil"></i></a>

                                {{-- Form untuk tombol Hapus --}}
                                <form action="{{ route('admin.walimurid.destroy', $wali->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Anda yakin ingin menghapus wali murid ini? Menghapus wali murid juga akan menghapus data siswa yang terkait.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" title="Hapus"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data wali murid.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $waliMurid->links() }}
            </div>
        </div>
    </div>
</div>
@endsection