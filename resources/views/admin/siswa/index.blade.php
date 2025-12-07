@extends('layouts.admin')

@section('title', 'Manajemen Data Siswa')

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

    .content-header .fa-users {
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

    .modal-body label {
        color: #075985;
        font-weight: 600;
    }

    .modal-body .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
    }

    .modal-body .form-control:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #0c4a6e;
        border: none;
        border-radius: 10px;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
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
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="fa fa-users"></i>Manajemen Data Siswa<br><small>Lihat dan Crud Siswa</small>
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
            {{-- Filter Kelas dan Tombol Tambah --}}
            <div class="block-options pull-right form-inline">
                {{-- Form Filter Kelas --}}
                <form action="{{ route('admin.siswa.index') }}" method="GET" style="display: inline-block; margin-right: 10px;">
                    <label for="kelas" class="hidden-xs">Filter Kelas: </label>
                    <select name="kelas" id="kelas" class="form-control input-sm" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option> {{-- Opsi untuk menampilkan semua --}}
                        @foreach($daftarKelas as $kelas)
                        <option value="{{ $kelas }}" {{ $kelas == $kelasDipilih ? 'selected' : '' }}>
                            {{ $kelas }}
                        </option>
                        @endforeach
                    </select>
                </form>
                {{-- Tombol Tambah Siswa --}}
                <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Tambah Siswa
                </a>
            </div>
            <h2><strong>Data Siswa {{ $kelasDipilih ? '(Kelas ' . $kelasDipilih . ')' : '' }}</strong></h2>
        </div>

        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-vcenter table-striped table-hover table-bordered"> {{-- Tambah table-bordered --}}
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Wali Murid</th>
                            <th>Kelas</th>
                            <th class="text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswa as $sw)
                        <tr>
                            <th class="text-center">{{ $loop->iteration + ($siswa->currentPage() - 1) * $siswa->perPage() }}</th> {{-- Penomoran yang benar untuk pagination --}}
                            <td>{{$sw->nis}}</td>
                            <td>{{$sw->nama_siswa}}</td>
                            <td>{{$sw->user->name ?? 'Belum Ditautkan'}}</td>
                            <td>{{$sw->kelas}}</td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-target="#edit{{ $sw->id }}" class="btn btn-xs btn-warning" title="Edit Siswa">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#delete{{ $sw->id }}" class="btn btn-xs btn-danger" title="Hapus Siswa">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                @if($kelasDipilih)
                                Tidak ada data siswa ditemukan untuk kelas {{ $kelasDipilih }}.
                                @else
                                Data siswa belum ada.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{-- PERBAIKAN: Tambahkan appends agar filter terbawa saat ganti halaman --}}
                {{ $siswa->appends(['kelas' => $kelasDipilih])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Modal Tambah, Edit, Hapus (Kode Modal tidak berubah signifikan) --}}
@push('modal')
{{-- Modal Tambah --}}
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Tambah Data Siswa</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.siswa.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" placeholder="Masukkan NIS" value="{{ old('nis') }}">
                        @error('nis') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" placeholder="Masukkan nama siswa" value="{{ old('nama_siswa') }}">
                        @error('nama_siswa') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="username_wali_tambah">Username Wali Murid</label>
                        <input type="text" id="username_wali_tambah" name="username_wali" class="form-control @error('username_wali') is-invalid @enderror" placeholder="Ketik username wali murid" value="{{ old('username_wali') }}">
                        @error('username_wali') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        {{-- Ganti Input Teks Kelas Menjadi Dropdown --}}
                        <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                            @foreach($daftarKelas as $kelasOption)
                            <option value="{{ $kelasOption }}" {{ old('kelas') == $kelasOption ? 'selected' : '' }}>{{ $kelasOption }}</option>
                            @endforeach
                        </select>
                        @error('kelas') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
@foreach ($siswa as $sw)
<div class="modal fade" id="edit{{ $sw->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Edit Data Siswa</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.siswa.update', $sw->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{old('nis', $sw->nis)}}">
                        @error('nis')<div class="invalid-feedback">{{$message}}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" name="nama_siswa" value="{{old('nama_siswa', $sw->nama_siswa)}}">
                        @error('nama_siswa')<div class="invalid-feedback">{{$message}}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="username_wali_edit_{{ $sw->id }}">Username Wali Murid</label>
                        <input type="text" id="username_wali_edit_{{ $sw->id }}" name="username_wali" class="form-control @error('username_wali') is-invalid @enderror" placeholder="Ketik username wali murid" value="{{ old('username_wali', $sw->user->username ?? '') }}">
                        @error('username_wali') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        {{-- Ganti Input Teks Kelas Menjadi Dropdown --}}
                        <select name="kelas" class="form-control @error('kelas') is-invalid @enderror">
                            @foreach($daftarKelas as $kelasOption)
                            <option value="{{ $kelasOption }}" {{ old('kelas', $sw->kelas) == $kelasOption ? 'selected' : '' }}>{{ $kelasOption }}</option>
                            @endforeach
                        </select>
                        @error('kelas')<div class="invalid-feedback">{{$message}}</div>@enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Delete --}}
<div class="modal fade" id="delete{{ $sw->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title">Hapus Data Siswa</h5>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data <b>{{ $sw->nama_siswa }}</b>?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.siswa.destroy', $sw->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endpush