@extends('layouts.walimurid')

@section('title', 'Dashboard Wali Murid')

@push('css-custom')
<style>
    /* ================= HEADER DASHBOARD (SAMA DENGAN REKAP TAGIHAN) ================= */
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

    .content-header .gi-home {
        color: #0ea5e9;
        margin-right: 10px;
    }

    /* ================= BLOCK STYLING ================= */
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

    /* ================= LAYOUT KONTEN ================= */
    .content {
        min-height: 100%;
        padding-bottom: 20px;
    }

    .wali-dashboard-wrapper {
        padding: 0;
    }

    .wali-dashboard-row {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
    }

    .wali-dashboard-left,
    .wali-dashboard-right {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15);
        border: 2px solid rgba(14, 165, 233, 0.1);
    }

    .wali-dashboard-left {
        flex: 1 1 40%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .wali-dashboard-right {
        flex: 1 1 55%;
    }

    /* ================= KARTU ANAK (KIRI) ================= */
    .child-avatar-wrapper {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        border: 4px solid #cbd5e1;
        background: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
    }

    .child-avatar-wrapper img {
        max-width: 140px;
        height: auto;
    }

    .child-name {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        text-align: center;
    }

    .child-name span {
        font-weight: 500;
        color: #4b5563;
    }

    /* ================= PANEL DATA (KANAN) ================= */
    .child-info-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 18px;
        color: #111827;
    }

    .child-info-row {
        background: white;
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 12px 16px;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
    }

    .child-info-row:hover {
        background: #f0f9ff;
        border-color: #0ea5e9;
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.1);
    }

    .child-info-label {
        font-size: 14px;
        color: #111827;
        font-weight: 600;
    }

    .child-info-value {
        font-size: 14px;
        color: #111827;
        font-weight: 500;
        text-align: right;
    }

    .child-info-empty {
        text-align: center;
        padding: 40px 10px;
        color: #4b5563;
        font-size: 14px;
    }

    /* Responsive untuk Mobile */
    @media (max-width: 768px) {
        .content-header {
            padding: 20px 15px;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .wali-dashboard-wrapper {
            padding: 10px 0 20px;
        }

        .wali-dashboard-row {
            flex-direction: column;
        }

        .wali-dashboard-left,
        .wali-dashboard-right {
            padding: 18px;
        }

        .child-avatar-wrapper {
            width: 180px;
            height: 180px;
        }

        .child-avatar-wrapper img {
            max-width: 120px;
        }

        .child-info-row {
            padding: 10px 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-home"></i>Dashboard
            <br>
            <small>Selamat Datang, {{ Auth::user()->name }}</small>
        </h1>
    </div>
</div>

<div class="content">
    <div class="block">
        <div class="block-title">
            <h2><strong>Data Anak</strong></h2>
        </div>
        <div class="block-content">
            <div class="wali-dashboard-wrapper">
                <div class="wali-dashboard-row">
                    {{-- Kartu Anak (Kiri) --}}
                    <div class="wali-dashboard-left">
                        @if ($siswaUtama)
                        <div class="child-avatar-wrapper">
                            <img src="{{ asset('admin-template/img/placeholders/avatars/icon.jpg') }}" alt="Avatar Anak">
                        </div>
                        <div class="child-name">
                            {{ $siswaUtama->nama_siswa }}
                            <br>
                            <span>Kelas {{ $siswaUtama->kelas }}</span>
                        </div>
                        @else
                        <div class="child-info-empty">
                            Belum ada data anak yang ditautkan ke akun Anda.
                        </div>
                        @endif
                    </div>

                    {{-- Panel Informasi (Kanan) --}}
                    <div class="wali-dashboard-right">
                        @if ($siswaUtama)
                        <div class="child-info-title">Informasi Data Anak</div>

                        <div class="child-info-row">
                            <div class="child-info-label">Nama Lengkap :</div>
                            <div class="child-info-value">{{ $siswaUtama->nama_siswa }}</div>
                        </div>

                        <div class="child-info-row">
                            <div class="child-info-label">Kelas :</div>
                            <div class="child-info-value">{{ $siswaUtama->kelas }}</div>
                        </div>

                        <div class="child-info-row">
                            <div class="child-info-label">Nama Orang Tua :</div>
                            <div class="child-info-value">{{ Auth::user()->name }}</div>
                        </div>

                        <div class="child-info-row">
                            <div class="child-info-label">Tahun Ajaran :</div>
                            <div class="child-info-value">
                                {{ now()->year }} / {{ now()->year + 1 }}
                            </div>
                        </div>

                        <div class="child-info-row">
                            <div class="child-info-label">Tagihan Lunas :</div>
                            <div class="child-info-value">
                                Rp{{ number_format($totalTagihanLunas ?? 0, 0, ',', '.') }},-
                            </div>
                        </div>
                        @else
                        <div class="child-info-empty">
                            Silakan hubungi admin untuk menautkan data anak ke akun Anda.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection