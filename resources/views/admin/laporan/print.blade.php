<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bimbingan Disetujui</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { margin-top: 50px; text-align: right; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()">Print Laporan</button>
        <button onclick="window.close()">Tutup</button>
    </div>

    <div class="header">
        <h2>LAPORAN DATA BIMBINGAN MAHASISWA & DOSEN</h2>
        <p>Universitas Antigravity</p>
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengajuan</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Dosen Pembimbing</th>
                <th>Judul Proposal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bimbingans as $index => $b)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $b->created_at->format('d/m/Y') }}</td>
                <td>{{ $b->mahasiswa->nim }}</td>
                <td>{{ $b->mahasiswa->nama }}</td>
                <td>{{ $b->dosen->nama }}</td>
                <td>{{ $b->judul }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Kepala Program Studi</strong></p>
    </div>

</body>
</html>
