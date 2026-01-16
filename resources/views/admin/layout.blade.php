<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="d-flex">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4>Simbion@Utama</h4>
        <ul>
            <li>Dashboard</li>
            <li>Manajemen Dosen</li>
            <li>Manajemen Mahasiswa</li>
            <li>Pengajuan Kuota</li>
            <li>Monitoring Kuota</li>
            <li>Pengajuan Pembimbing</li>
            <li>Laporan & Statistik</li>
            <li>Pengaturan Sistem</li>
        </ul>
    </div>

    <!-- MAIN -->
    <div class="content">
        <div class="topbar">
            Administrator
        </div>

        @yield('content')
    </div>
</div>

</body>
</html>
