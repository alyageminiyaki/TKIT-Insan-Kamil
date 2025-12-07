@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulir Konfirmasi Pembayaran Infaq</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Informasi Transfer:</strong>
                        <p class="mb-0">Silakan lakukan transfer ke rekening berikut sebelum mengisi formulir ini:</p>
                        <ul class="mb-0">
                            <li><strong>Bank:</strong> BCA</li>
                            <li><strong>No. Rekening:</strong> 1234567890</li>
                            <li><strong>Atas Nama:</strong> Yayasan Sekolah TK</li>
                        </ul>
                    </div>

                    <form action="{{ route('wali.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Menyimpan student_id secara tersembunyi --}}
                        <input type="hidden" name="student_id" value="{{ $siswa->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="payment_for_month" class="form-label">Pembayaran Bulan</label>
                                <select class="form-select @error('payment_for_month') is-invalid @enderror" id="payment_for_month" name="payment_for_month" required>
                                    <option selected disabled>Pilih Bulan</option>
                                    @php
                                    $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    @endphp
                                    @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                                @error('payment_for_month')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="payment_for_year" class="form-label">Tahun</label>
                                <select class="form-select @error('payment_for_year') is-invalid @enderror" id="payment_for_year" name="payment_for_year" required>
                                    @php
                                    $currentYear = date('Y');
                                    @endphp
                                    <option value="{{ $currentYear }}">{{ $currentYear }}</option>
                                    <option value="{{ $currentYear + 1 }}">{{ $currentYear + 1 }}</option>
                                </select>
                                @error('payment_for_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="payment_date" class="form-label">Tanggal Bayar</label>
                            <input type="date" class="form-control @error('payment_date') is-invalid @enderror" id="payment_date" name="payment_date" value="{{ old('payment_date') }}" required>
                            @error('payment_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Nominal Bayar</label>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $spp->nominal ?? '') }}" placeholder="Contoh: 150000" required>
                            @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proof_of_payment" class="form-label">Upload Bukti Pembayaran</label>
                            <input class="form-control @error('proof_of_payment') is-invalid @enderror" type="file" id="proof_of_payment" name="proof_of_payment" required>
                            <div class="form-text">File harus berupa gambar (jpg, png) dan maksimal 2MB.</div>
                            @error('proof_of_payment')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Kirim Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection