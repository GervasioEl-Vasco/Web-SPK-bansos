<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Seleksi Bansos {{ $periode }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            color: #1a202c;
        }
        .header {
            background: #1a3a6b;
            color: white;
            padding: 18px 24px;
            margin-bottom: 16px;
        }
        .header h1 { font-size: 14pt; font-weight: bold; margin-bottom: 4px; }
        .header h2 { font-size: 11pt; font-weight: normal; margin-bottom: 2px; }
        .header small { font-size: 8pt; opacity: 0.8; }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 12px;
            display: flex;
            gap: 24px;
        }
        .info-item { flex: 1; }
        .info-label { font-size: 8pt; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; }
        .info-value { font-size: 10pt; font-weight: bold; color: #1a3a6b; margin-top: 2px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        thead th {
            background: #1a3a6b;
            color: white;
            padding: 7px 8px;
            font-size: 8.5pt;
            text-align: left;
            font-weight: bold;
        }
        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody td {
            padding: 6px 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 8.5pt;
        }
        .text-center { text-align: center; }
        .badge-layak {
            background: #d1fae5;
            color: #065f46;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 8pt;
        }
        .badge-tidak {
            background: #fee2e2;
            color: #991b1b;
            padding: 2px 8px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 8pt;
        }
        .rank-cell { text-align: center; font-weight: bold; color: #1a3a6b; }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 8.5pt;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }

        .signature-area {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
        }
        .signature-box {
            text-align: center;
            width: 180px;
            font-size: 9pt;
        }
        .signature-line {
            border-bottom: 1px solid #1a3a6b;
            margin-top: 48px;
            margin-bottom: 4px;
        }

        .stats-row {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
        }
        .stat-box {
            flex: 1;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 12px;
            text-align: center;
        }
        .stat-box .num { font-size: 16pt; font-weight: bold; color: #1a3a6b; }
        .stat-box .lbl { font-size: 7.5pt; color: #64748b; }
    </style>
</head>
<body>

<div class="header">
    <h1>🏛️ LAPORAN SELEKSI PENERIMA BANTUAN SOSIAL</h1>
    <h2>Sistem Pendukung Keputusan – Metode Simple Additive Weighting (SAW)</h2>
    <small>Digenerate pada: {{ now()->locale('id')->isoFormat('D MMMM Y, HH:mm') }}</small>
</div>

<div class="stats-row">
    <div class="stat-box">
        <div class="num">{{ $hasilSeleksi->count() }}</div>
        <div class="lbl">Total Diseleksi</div>
    </div>
    <div class="stat-box">
        <div class="num" style="color:#065f46;">{{ $totalLayak }}</div>
        <div class="lbl">Penerima Layak</div>
    </div>
    <div class="stat-box">
        <div class="num" style="color:#991b1b;">{{ $totalTidakLayak }}</div>
        <div class="lbl">Tidak Layak</div>
    </div>
    <div class="stat-box">
        <div class="num">{{ $periode }}</div>
        <div class="lbl">Periode Seleksi</div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th class="text-center" style="width:6%;">No</th>
            <th class="text-center" style="width:6%;">Rank</th>
            <th style="width:16%;">NIK</th>
            <th style="width:20%;">Nama Penduduk</th>
            <th style="width:22%;">Alamat</th>
            <th style="width:14%;">Pekerjaan</th>
            <th class="text-center" style="width:10%;">Nilai (Vi)</th>
            <th class="text-center" style="width:6%;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hasilSeleksi as $loop => $h)
        <tr>
            <td class="text-center">{{ $loop + 1 }}</td>
            <td class="rank-cell">{{ $h->ranking }}</td>
            <td style="font-family:monospace; font-size:8pt;">{{ $h->penduduk->nik }}</td>
            <td><strong>{{ $h->penduduk->nama }}</strong></td>
            <td style="font-size:8pt;">{{ $h->penduduk->alamat }}</td>
            <td style="font-size:8pt;">{{ $h->penduduk->pekerjaan }}</td>
            <td class="text-center"><strong>{{ number_format($h->nilai_akhir, 6) }}</strong></td>
            <td class="text-center">
                @if($h->status == 'layak')
                    <span class="badge-layak">✓ Layak</span>
                @else
                    <span class="badge-tidak">✗ Tidak</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="signature-area">
    <div class="signature-box">
        <p>Mengetahui,</p>
        <p><em>Kepala Desa</em></p>
        <div class="signature-line"></div>
        <p>( ........................................................ )</p>
        <p style="font-size:8pt;">NIP. –</p>
    </div>
</div>

<div class="footer">
    <p>Dicetak oleh: Sistem Pendukung Keputusan Bantuan Sosial | Metode SAW | Periode {{ $periode }}</p>
    <p>Referensi: Suprapto et al. (2024) MALCOM; Jurnal Dimamu (2025); Muhibah & Maryam (2021) EMITTER</p>
</div>

</body>
</html>
