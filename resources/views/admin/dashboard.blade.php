@extends('layouts.admin')

@section('title', 'Dashboard')

{{-- CSS Kustom untuk Widget --}}
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

    .content-header .gi-home {
        color: #0ea5e9;
        margin-right: 10px;
    }

    /* Container Widget dengan Tema Biru Muda */
    .widget-group-container {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.1);
        border: 2px solid rgba(14, 165, 233, 0.1);
    }

    /* Container untuk Pie Chart */
    .pie-chart-container {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.1);
        border: 2px solid #e2e8f0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .pie-chart-title {
        color: #0c4a6e;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .pie-chart-wrapper {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 250px;
        padding: 15px 0;
    }

    #chart-status-transaksi {
        width: 100%;
        height: 100%;
        min-height: 250px;
    }

    /* Legend untuk Pie Chart */
    .pie-chart-legend {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .pie-chart-legend-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 15px;
        background: #f8fafc;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .pie-chart-legend-item:hover {
        background: #f0f9ff;
        transform: translateX(5px);
    }

    .pie-chart-legend-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pie-chart-legend-color {
        width: 20px;
        height: 20px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
    }

    .pie-chart-legend-label {
        color: #0c4a6e;
        font-size: 14px;
        font-weight: 600;
    }

    .pie-chart-legend-value {
        color: #075985;
        font-size: 14px;
        font-weight: 700;
    }

    /* Tooltip untuk Pie Chart */
    .pie-chart-tooltip {
        position: absolute;
        display: none;
        padding: 10px 15px;
        background: linear-gradient(135deg, #0c4a6e 0%, #075985 100%);
        color: white;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        pointer-events: none;
        white-space: nowrap;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .pie-chart-tooltip::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid #075985;
    }

    /* Container untuk Summary Boxes */
    .summary-boxes-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        height: 100%;
    }

    .summary-boxes-top {
        display: flex;
        gap: 20px;
    }

    .summary-boxes-bottom {
        display: flex;
        flex-direction: column;
        gap: 20px;
        flex: 1;
    }

    /* PERBAIKAN: Gunakan class .row langsung tanpa .inner-widget-row */
    /* dan atur margin negatif untuk counteract padding container */
    .widget-group-container .row {
        margin-left: -10px;
        margin-right: -10px;
        display: flex;
        align-items: stretch;
    }

    /* PERBAIKAN: Atur padding kolom agar ada jarak antar card */
    .widget-group-container .row>[class*='col-'] {
        padding-left: 10px;
        padding-right: 10px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
    }

    /* Pastikan chart container juga menggunakan flex */
    .widget-group-container .row>[class*='col-'] .chart-container {
        display: flex;
        flex-direction: column;
    }

    /* Card dengan Tema Biru Muda */
    .info-card {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.1);
        display: flex;
        align-items: center;
        width: 100%;
        /* Card mengisi lebar kolom */
        transition: all 0.3s ease;
        text-decoration: none !important;
        color: inherit;
        position: relative;
        overflow: hidden;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        transition: width 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(14, 165, 233, 0.2);
        border-color: #0ea5e9;
    }

    .info-card:hover::before {
        width: 100%;
        opacity: 0.1;
    }

    .info-card-icon {
        margin-right: 20px;
        flex-shrink: 0;
        /* Mencegah ikon mengecil */
        background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
        padding: 15px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 10px rgba(14, 165, 233, 0.15);
    }

    .info-card-icon img {
        max-width: 55px;
        height: auto;
        filter: drop-shadow(0 2px 4px rgba(14, 165, 233, 0.2));
    }

    .info-card-content {
        text-align: left;
        flex-grow: 1;
        /* Konten mengisi sisa ruang */
        overflow: hidden;
        /* Mencegah teks meluber */
    }

    .info-card-title {
        color: #0c4a6e;
        font-size: 14px;
        margin-bottom: 8px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-card-value {
        font-size: 32px;
        font-weight: 700;
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.1;
    }

    .info-card-value-small {
        font-size: 22px;
        font-weight: 700;
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.1;
    }

    /* Card kecil untuk top row */
    .info-card-small {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.1);
        display: flex;
        align-items: center;
        flex: 1;
        transition: all 0.3s ease;
        text-decoration: none !important;
        color: inherit;
        position: relative;
        overflow: hidden;
    }

    .info-card-small::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        transition: width 0.3s ease;
    }

    .info-card-small:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(14, 165, 233, 0.2);
        border-color: #0ea5e9;
    }

    .info-card-small:hover::before {
        width: 100%;
        opacity: 0.1;
    }

    .info-card-small .info-card-icon {
        margin-right: 15px;
        padding: 12px;
    }

    .info-card-small .info-card-icon img {
        max-width: 40px;
    }

    .info-card-small .info-card-title {
        font-size: 12px;
        margin-bottom: 5px;
    }

    .info-card-small .info-card-value,
    .info-card-small .info-card-value-small {
        font-size: 20px;
    }

    /* Card besar untuk bottom row */
    .info-card-large {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.1);
        display: flex;
        align-items: center;
        flex: 1;
        transition: all 0.3s ease;
        text-decoration: none !important;
        color: inherit;
        position: relative;
        overflow: hidden;
    }

    .info-card-large::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        transition: width 0.3s ease;
    }

    .info-card-large:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(14, 165, 233, 0.2);
        border-color: #0ea5e9;
    }

    .info-card-large:hover::before {
        width: 100%;
        opacity: 0.1;
    }

    /* Animation */
    .animation-fadeInQuick {
        animation: fadeInQuick 0.6s ease-out;
    }

    @keyframes fadeInQuick {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .content-header {
            padding: 20px;
        }

        .widget-group-container {
            padding: 15px;
        }

        .info-card,
        .info-card-small,
        .info-card-large {
            padding: 20px;
        }

        .info-card-value {
            font-size: 28px;
        }

        .info-card-value-small {
            font-size: 20px;
        }

        .summary-boxes-top {
            flex-direction: column;
        }

        .pie-chart-wrapper {
            min-height: 220px;
        }

        #chart-status-transaksi {
            min-height: 220px;
        }

        .pie-chart-legend-item {
            padding: 8px 12px;
        }

        .pie-chart-legend-label {
            font-size: 12px;
        }

        .pie-chart-legend-value {
            font-size: 12px;
        }

        .pie-chart-legend-color {
            width: 16px;
            height: 16px;
        }
    }
</style>
@endpush


@section('content')
{{-- Header Halaman --}}
<div class="content-header">
    <div class="header-section" style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="margin: 0;">
            DASHBOARD
        </h1>
        <i class="gi gi-home" style="font-size: 24px;"></i>
    </div>
</div>

{{-- Isi Halaman --}}
<div class="content">
    <div class="widget-group-container animation-fadeInQuick">
        <div class="row">
            {{-- Panel Kiri: Pie Chart --}}
            <div class="col-md-6">
                <div class="pie-chart-container">
                    <div class="pie-chart-title">PIE CHART</div>
                    <div class="pie-chart-wrapper">
                        <div id="chart-status-transaksi"
                            data-lunas="{{ $tagihanLunasBulanIni }}"
                            data-belum-lunas="{{ $tagihanBelumLunasBulanIni }}"
                            data-menunggu-verifikasi="{{ $tagihanMenungguVerifikasi }}">
                        </div>
                    </div>
                    {{-- Legend/Definisi Warna --}}
                    <div class="pie-chart-legend" id="pie-chart-legend">
                        {{-- Legend akan diisi oleh JavaScript --}}
                    </div>
                </div>
            </div>

            {{-- Panel Kanan: Summary Boxes --}}
            <div class="col-md-6">
                <div class="summary-boxes-container">
                    {{-- Top Row: 2 Box Kecil --}}
                    <div class="summary-boxes-top">
                        {{-- Box Total Siswa --}}
                        <a href="{{ route('admin.siswa.index') }}" class="info-card-small">
                            <div class="info-card-icon">
                                <img src="{{ asset('admin-template/img/icons/siswa.png') }}" alt="Siswa">
                            </div>
                            <div class="info-card-content">
                                <div class="info-card-title">Total Siswa</div>
                                <div class="info-card-value">{{ $jumlahSiswa }}</div>
                            </div>
                        </a>

                        {{-- Box Uang Masuk --}}
                        <div class="info-card-small">
                            <div class="info-card-icon">
                                <img src="{{ asset('admin-template/img/icons/uang.png') }}" alt="Uang Masuk">
                            </div>
                            <div class="info-card-content">
                                <div class="info-card-title">Uang Masuk</div>
                                <div class="info-card-value-small">Rp{{ number_format($totalUangMasuk ?? 0, 0, ',', '.') }},-</div>
                            </div>
                        </div>
                    </div>

                    {{-- Bottom Row: 3 Box Besar Vertikal --}}
                    <div class="summary-boxes-bottom">
                        {{-- Box Lunas --}}
                        <a href="{{ route('admin.tagihan.index', ['tahun' => date('Y'), 'status' => 'lunas']) }}" class="info-card-large">
                            <div class="info-card-icon">
                                <img src="{{ asset('admin-template/img/icons/lunas.png') }}" alt="Lunas">
                            </div>
                            <div class="info-card-content">
                                <div class="info-card-title">Lunas</div>
                                <div class="info-card-value">{{ $tagihanLunasBulanIni }}</div>
                            </div>
                        </a>

                        {{-- Box Belum Lunas --}}
                        <a href="{{ route('admin.tagihan.index', ['tahun' => date('Y'), 'status' => 'belum_lunas']) }}" class="info-card-large">
                            <div class="info-card-icon">
                                <img src="{{ asset('admin-template/img/icons/belum-lunas.png') }}" alt="Belum Lunas">
                            </div>
                            <div class="info-card-content">
                                <div class="info-card-title">Belum Lunas</div>
                                <div class="info-card-value">{{ $tagihanBelumLunasBulanIni }}</div>
                            </div>
                        </a>

                        {{-- Box Menunggu Verifikasi --}}
                        <a href="{{ route('admin.tagihan.index', ['tahun' => date('Y'), 'status' => 'menunggu_verifikasi']) }}" class="info-card-large">
                            <div class="info-card-icon">
                                <img src="{{ asset('admin-template/img/icons/validasi.png') }}" alt="Validasi">
                            </div>
                            <div class="info-card-content">
                                <div class="info-card-title">Menunggu Verifikasi</div>
                                <div class="info-card-value">{{ $tagihanMenungguVerifikasi }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js-custom')
<script>
    $(document).ready(function() {
        // Data untuk pie chart dari data attributes
        var chartElement = $('#chart-status-transaksi');
        var dataLunas = parseInt(chartElement.data('lunas')) || 0;
        var dataBelumLunas = parseInt(chartElement.data('belum-lunas')) || 0;
        var dataMenungguVerifikasi = parseInt(chartElement.data('menunggu-verifikasi')) || 0;

        // Total untuk menghitung persentase
        var total = dataLunas + dataBelumLunas + dataMenungguVerifikasi;

        // Jika tidak ada data, tampilkan pesan
        if (total === 0) {
            $('#chart-status-transaksi').html(
                '<div style="text-align: center; padding: 50px; color: #0c4a6e;">' +
                '<i class="fa fa-info-circle" style="font-size: 48px; margin-bottom: 15px; color: #0ea5e9;"></i><br>' +
                '<strong style="font-size: 16px;">Tidak ada data transaksi bulan ini</strong>' +
                '</div>'
            );
            return;
        }

        // Data untuk Flot pie chart dengan warna yang lebih menarik
        var pieData = [{
                label: 'Lunas',
                data: dataLunas,
                color: '#10b981' // Hijau untuk lunas
            },
            {
                label: 'Belum Lunas',
                data: dataBelumLunas,
                color: '#ef4444' // Merah untuk belum lunas
            },
            {
                label: 'Menunggu Verifikasi',
                data: dataMenungguVerifikasi,
                color: '#f59e0b' // Orange untuk menunggu verifikasi
            }
        ];

        // Inisialisasi Pie Chart (tanpa label di dalam, lebih besar sedikit)
        $.plot('#chart-status-transaksi', pieData, {
            series: {
                pie: {
                    show: true,
                    radius: 0.7,
                    innerRadius: 0.4,
                    label: {
                        show: false // Hapus label di dalam pie chart
                    },
                    highlight: {
                        opacity: 0.3
                    }
                }
            },
            legend: {
                show: false
            },
            grid: {
                hoverable: true,
                clickable: false
            }
        });

        // Buat legend/definisi warna di bawah pie chart
        var legendHtml = '';
        pieData.forEach(function(item) {
            var value = item.data;
            var percent = total > 0 ? Math.round((value / total) * 100) : 0;
            legendHtml += '<div class="pie-chart-legend-item">' +
                '<div class="pie-chart-legend-left">' +
                '<span class="pie-chart-legend-color" style="background-color: ' + item.color + ';"></span>' +
                '<span class="pie-chart-legend-label">' + item.label + '</span>' +
                '</div>' +
                '<span class="pie-chart-legend-value">' + value + ' (' + percent + '%)</span>' +
                '</div>';
        });
        $('#pie-chart-legend').html(legendHtml);

        // Buat elemen tooltip
        var $tooltip = $('<div class="pie-chart-tooltip"></div>').appendTo('body');

        // Tooltip saat hover
        $('#chart-status-transaksi').bind('plothover', function(event, pos, item) {
            if (item) {
                var percent = Math.round(item.series.percent);
                var label = item.series.label;
                var value = item.series.data;

                // Update tooltip content
                $tooltip.html(
                    '<div style="text-align: center;">' +
                    '<div style="font-size: 14px; margin-bottom: 4px; font-weight: 700;">' + label + '</div>' +
                    '<div style="font-size: 12px; opacity: 0.9;">Nilai: ' + value + '</div>' +
                    '<div style="font-size: 12px; opacity: 0.9;">Persentase: ' + percent + '%</div>' +
                    '</div>'
                ).fadeIn(200);

                // Posisikan tooltip di dekat cursor
                var tooltipX = pos.pageX + 15;
                var tooltipY = pos.pageY - 15;

                // Pastikan tooltip tidak keluar dari viewport
                var tooltipWidth = $tooltip.outerWidth();
                var tooltipHeight = $tooltip.outerHeight();

                if (tooltipX + tooltipWidth > $(window).width()) {
                    tooltipX = pos.pageX - tooltipWidth - 15;
                }

                if (tooltipY - tooltipHeight < 0) {
                    tooltipY = pos.pageY + 15;
                }

                $tooltip.css({
                    left: tooltipX + 'px',
                    top: tooltipY + 'px'
                });

                $('#chart-status-transaksi').css('cursor', 'pointer');
            } else {
                $tooltip.fadeOut(200);
                $('#chart-status-transaksi').css('cursor', 'default');
            }
        });

        // Sembunyikan tooltip saat mouse keluar
        $('#chart-status-transaksi').bind('mouseleave', function() {
            $tooltip.fadeOut(200);
        });
    });
</script>
@endpush