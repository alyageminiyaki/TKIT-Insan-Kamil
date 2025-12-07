@extends('layouts.walimurid')
@section('title', 'Form Pembayaran Tagihan')

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
        color: #0c4a6e;
    }

    .block-content h4 {
        color: #075985;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    .table tbody tr {
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody td {
        color: #0c4a6e;
        padding: 12px 15px;
    }

    .table tbody td strong {
        color: #075985;
        font-weight: 600;
    }

    .table tbody td h4 {
        color: #0ea5e9;
        font-weight: 700;
        margin: 0;
    }

    .form-group label {
        color: #075985;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
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

    .text-danger {
        color: #ef4444 !important;
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

        .block-title {
            padding: 15px;
        }

        .block-title h2 {
            font-size: 16px;
        }

        .block-content {
            padding: 15px;
        }

        .block-content .row {
            margin: 0;
        }

        .block-content .col-md-6 {
            width: 100%;
            margin-bottom: 20px;
            padding: 0;
        }

        .block-content h4 {
            font-size: 16px;
        }

        .table {
            font-size: 12px;
        }

        .table tbody td {
            padding: 10px 8px;
            font-size: 12px;
        }

        .table tbody td h4 {
            font-size: 16px;
        }

        .form-control {
            padding: 10px 12px;
            font-size: 14px;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            margin-bottom: 10px;
            padding: 12px 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="header-section">
        <h1><i class="gi gi-money"></i>Pembayaran Tagihan</h1>
    </div>
</div>
<div class="content">
    <div class="block">
        <div class="block-title">
            <h2><strong>Detail Tagihan & Form Upload</strong></h2>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-md-6">
                    <h4>Detail Tagihan</h4>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td style="width: 30%;"><strong>Nama Siswa</strong></td>
                                <td>: {{ $tagihan->siswa->nama_siswa }}</td>
                            </tr>
                            <tr>
                                <td><strong>Periode Tagihan</strong></td>
                                <td>: {{ \Carbon\Carbon::create()->month((int)$tagihan->bulan)->format('F') }} {{ $tagihan->tahun }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Tagihan</strong></td>
                                <td>: <h4>Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Upload Bukti Pembayaran</h4>
                    <form action="{{ route('walimurid.tagihan.update', $tagihan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="bukti_pembayaran">Pilih File Gambar (JPG, PNG)</label>
                            <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror">
                            @error('bukti_pembayaran') <div class="text-danger mt-2">{{$message}}</div> @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload & Kirim</button>
                            <a href="{{ route('walimurid.tagihan.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection