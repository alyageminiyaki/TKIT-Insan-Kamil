@extends('layouts.walimurid')
@section('title', 'Form Pembayaran Tagihan')

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
                                <td>: {{ \Carbon\Carbon::create()->month($tagihan->bulan)->format('F') }} {{ $tagihan->tahun }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Tagihan</strong></td>
                                <td>: <h4>Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</h4></td>
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