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

    .card-body {
        padding: 25px;
        color: #0c4a6e;
    }

    .btn-primary {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
        color: white;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
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
    }

    .table tbody tr:hover {
        background-color: #f0f9ff;
    }

    .table tbody td {
        color: #0c4a6e;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
        border-radius: 10px;
    }

    .alert-primary {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border-left: 4px solid #3b82f6;
        border-radius: 10px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border-left: 4px solid #ef4444;
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

    .modal-body label {
        color: #075985;
        font-weight: 600;
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
    }

    .form-control:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        border-radius: 10px;
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #0c4a6e;
        border: none;
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

        .card-body {
            padding: 15px;
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

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
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

        @if ($message = Session::get('update'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($message = Session::get('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{$message}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary btn-sm">Tambah Infaq</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Bulan</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($spp as $no => $s)
                            <tr>
                                <th scope="row">{{ ++$no }}</th>
                                <td>{{$s->bulan}}</td>
                                <td>{{'Rp. ' . number_format($s->nominal, 2, ',', '.') }}</td>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $s->id }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#delete{{ $s->id }}" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                                @empty
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    <div>
                                        data infaq belum ada
                                    </div>
                                </div>
                                @endforelse
                            </tr>
                        </tbody>
                    </table>
                    {{ $spp->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modal')
<!-- Modal tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Infaq</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('spp.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="text" class="form-control @error('bulan')
                        is-invalid
                    @enderror"
                            name="bulan" placeholder="masukkan bulan dengan benar">
                        @error('bulan')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nominal</label>
                        <input type="number" class="form-control @error('nominal')
                        is-invalid
                    @enderror"
                            name="nominal" placeholder="masukkan nominal dengan benar">
                        @error('nominal')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($spp as $s)
<div class="modal fade" id="edit{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('spp.update', $s->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="text" class="form-control @error('bulan')
                        is-invalid
                    @enderror"
                            name="bulan" value="{{old('bulan', $s->bulan)}}"
                            placeholder="masukkan bulan dengan benar">
                        @error('bulan')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">nominal</label>
                        <input type="number" class="form-control @error('nominal')
                        is-invalid
                    @enderror"
                            name="nominal" value="{{old('nominal', $s->nominal)}}"
                            placeholder="masukkan nominal dengan benar">

                        @error('nominal')
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Delete -->
@foreach ($spp as $s)
<div class="modal fade" id="delete{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Infaq</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>apakah anda yakin menghapus data <b>{{ $s->bulan }}</b></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="{{ route('spp.destroy', $s->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endpush