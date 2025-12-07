<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kuitansi Pembayaran</title>
    <style>
        /* CSS Wajib untuk dompdf */
        @page {
            margin: 0px;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0px;
            font-size: 14px;
            color: #333;
        }

        /* Container Utama */
        .container {
            width: 680px;
            /* Lebar standar kertas A4/Invoice */
            margin: 40px auto;
            position: relative;
        }

        /* Header */
        .header {
            display: block;
            margin-bottom: 30px;
        }

        .header .logo {
            float: left;
            width: 150px;
            /* Ganti dengan path logo TK Anda jika ada */
            /* font-size: 24px; font-weight: bold; color: #4a90e2; */
        }

        .header .invoice-title {
            float: right;
            text-align: right;
        }

        .header .invoice-title h1 {
            margin: 0;
            font-size: 32px;
            color: #4a90e2;
            /* Biru */
        }

        .header .invoice-title p {
            margin: 0;
            font-size: 14px;
        }

        /* Info Kuitansi & Siswa */
        .info {
            margin-bottom: 30px;
        }

        .info .tk-info {
            float: left;
            width: 45%;
        }

        .info .wali-info {
            float: right;
            width: 45%;
            text-align: right;
        }

        .info h3 {
            margin: 0 0 10px 0;
            font-size: 15px;
            color: #555;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }

        .info p {
            margin: 2px 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .info strong {
            color: #000;
        }

        /* Tabel Tagihan */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f8f9fa;
            /* Latar abu-abu header tabel */
            font-weight: bold;
        }

        .invoice-table .text-right {
            text-align: right;
        }

        /* Total */
        .total-section {
            width: 100%;
            margin-top: 20px;
        }

        .total-table {
            float: right;
            width: 40%;
            border-collapse: collapse;
        }

        .total-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .total-table .total-label {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .total-table .total-amount {
            font-weight: bold;
            font-size: 20px;
            text-align: right;
            background-color: #e6f7ff;
            /* Latar biru muda untuk total */
            color: #1d6a96;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #888;
            font-size: 12px;
            text-align: center;
        }

        /* Stempel Lunas */
        .paid-stamp {
            position: absolute;
            z-index: -1;
            top: 250px;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            font-size: 100px;
            color: rgba(40, 167, 69, 0.15);
            /* Hijau transparan */
            font-weight: bold;
            border: 15px solid rgba(40, 167, 69, 0.15);
            padding: 10px 40px;
            border-radius: 10px;
            text-transform: uppercase;
        }

        /* Helper */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="paid-stamp">Lunas</div>

        <div class="header clearfix">
            <div class="logo">
                {{-- Ganti dengan logo Anda jika ada --}}
                <h2 style="color: #4a90e2; margin: 0;">TK INSAN KAMIL</h2>
            </div>
            <div class="invoice-title">
                <h1>KUITANSI</h1>
                <p>No: INV/{{ $tagihan->tahun }}/{{ str_pad($tagihan->bulan, 2, '0', STR_PAD_LEFT) }}/{{ $tagihan->id }}</p>
                <p>Tanggal Lunas: {{ $tagihan->pembayaran ? \Carbon\Carbon::parse($tagihan->pembayaran->tanggal_transfer)->format('d F Y') : 'N/A' }}</p>
            </div>
        </div>

        <div class="info clearfix">
            <div class="tk-info">
                <h3>Ditagihkan oleh:</h3>
                <p>
                    <strong>TK Insan Kamil</strong><br>
                    Jl. Alamat Sekolah No. 123<br>
                    Cikampek, Karawang<br>
                    Jawa Barat, 41373
                </p>
            </div>
            <div class="wali-info">
                <h3>Dibayar oleh:</h3>
                <p>
                    <strong>{{ $tagihan->siswa->user->name ?? 'N/A' }}</strong><br>
                    (Wali Murid dari {{ $tagihan->siswa->nama_siswa ?? 'N/A' }})<br>
                    Kelas: {{ $tagihan->siswa->kelas ?? 'N/A' }}
                </p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th class="text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Pembayaran Infaq SPP Bulan {{ \Carbon\Carbon::create()->month((int)$tagihan->bulan)->format('F') }} {{ $tagihan->tahun }}
                        <br>
                        <small>Siswa: {{ $tagihan->siswa->nama_siswa ?? 'N/A' }}</small>
                    </td>
                    <td class="text-right">Rp{{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section clearfix">
            <table class="total-table">
                <tr>
                    <td class="total-label">Subtotal</td>
                    <td class="text-right">Rp{{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="total-label">Pajak</td>
                    <td class="text-right">Rp0</td>
                </tr>
                <tr>
                    <td class="total-label total-amount">Total Bayar</td>
                    <td class="total-amount">Rp{{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Terima kasih atas pembayaran Anda. Kuitansi ini dicetak otomatis oleh sistem.</p>
        </div>
    </div>
</body>

</html>