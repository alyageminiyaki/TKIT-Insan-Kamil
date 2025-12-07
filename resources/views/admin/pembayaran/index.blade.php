@extends('layouts.main')

@push('css-custom')
<style>
    /* Tema Biru Muda - Konsisten dengan Login/Register */
    body {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important;
        min-height: 100vh;
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
        color: white;
        font-weight: 700;
        padding: 20px 25px;
        border-bottom: none;
    }

    .card-title {
        color: white;
    }

    .card-body {
        padding: 25px;
        color: #0c4a6e;
    }

    .table thead {
        background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
    }

    .table thead th {
        color: #075985;
        font-weight: 700;
        border-bottom: 2px solid #0ea5e9;
    }

    .table tbody tr:hover {
        background-color: #f0f9ff;
    }

    .table tbody td {
        color: #0c4a6e;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 8px;
    }

    .badge.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        color: white;
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: white;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        color: white;
    }

    .btn-info {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border: none;
        color: white;
        border-radius: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border: none;
        color: white;
        border-radius: 8px;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
        border-radius: 10px;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border-left: 4px solid #f59e0b;
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

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 10px;
    }

    .pagination>li>a {
        color: #0ea5e9;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
    }

    .pagination>.active>a {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border-color: #0ea5e9;
        color: white;
    }

    /* Responsive untuk Mobile */
    @media (max-width: 768px) {
        .card {
            margin: 0 10px;
        }

        .card-header {
            padding: 15px;
        }

        .card-title {
            font-size: 16px;
        }

        .card-body {
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

        .badge {
            padding: 4px 8px;
            font-size: 10px;
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 11px;
            margin-bottom: 5px;
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

        .modal-body img {
            max-width: 100%;
            height: auto;
        }

        .pagination {
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Manajemen Validasi Pembayaran</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Infaq Bulan</th>
                                    <th scope="col">Tgl. Konfirmasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembayaran as $bayar)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $bayar->siswa->nama_siswa ?? 'Siswa tidak ditemukan' }}</td>
                                    <td>{{ $bayar->siswa->kelas->nama_kelas ?? '-' }}</td>
                                    <td>{{ $bayar->payment_for_month }} {{ $bayar->payment_for_year }}</td>
                                    <td>{{ \Carbon\Carbon::parse($bayar->payment_date)->format('d M Y') }}</td>
                                    <td>
                                        @if($bayar->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($bayar->status == 'tervalidasi')
                                        <span class="badge bg-success">Tervalidasi</span>
                                        @else
                                        <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#lihatBukti{{ $bayar->id }}">
                                            Lihat Bukti
                                        </button>
                                        @if($bayar->status == 'pending')
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#validasi{{ $bayar->id }}">
                                            Validasi
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="alert alert-warning m-0">
                                            Belum ada data pembayaran yang perlu divalidasi.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $pembayaran->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
@foreach ($pembayaran as $bayar)
<!-- Modal Lihat Bukti -->
<div class="modal fade" id="lihatBukti{{ $bayar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran: {{ $bayar->siswa->nama_siswa }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($bayar->proof_of_payment)
                <img src="{{ asset('storage/' . $bayar->proof_of_payment) }}" alt="Bukti Pembayaran" class="img-fluid">
                @else
                <p class="text-center">Tidak ada bukti pembayaran yang diunggah.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Validasi -->
<div class="modal fade" id="validasi{{ $bayar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Validasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Anda akan memvalidasi pembayaran untuk:</p>
                <ul>
                    <li>Nama: <strong>{{ $bayar->siswa->nama_siswa }}</strong></li>
                    <li>Bulan: <strong>{{ $bayar->payment_for_month }} {{ $bayar->payment_for_year }}</strong></li>
                </ul>
                <p>Pastikan bukti transfer sudah sesuai. Lanjutkan?</p>
            </div>
            <div class="modal-footer justify-content-between">
                {{-- Form untuk menolak pembayaran --}}
                <form action="{{ route('pembayaran.update', $bayar->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="ditolak">
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </form>
                {{-- Form untuk menerima/memvalidasi pembayaran --}}
                <form action="{{ route('pembayaran.update', $bayar->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="tervalidasi">
                    <button type="submit" class="btn btn-success">Ya, Validasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endpush