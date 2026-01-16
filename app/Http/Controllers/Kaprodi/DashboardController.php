<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengajuanPembimbing;
use App\Models\PengajuanKuota;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Program-level statistics
        $totalDosen = Dosen::where('status', 'aktif')->count();
        $totalMahasiswa = Mahasiswa::where('status', 'aktif')->count();
        
        $totalBimbinganAktif = PengajuanPembimbing::where('status', 'disetujui')->count();
        $pengajuanPending = PengajuanPembimbing::where('status', 'pending')->count();
        
        // Kuota utilization
        $totalKuota = Dosen::where('status', 'aktif')->sum('kuota');
        $kuotaTerpakai = $totalBimbinganAktif;
        $kuotaTersisa = max(0, $totalKuota - $kuotaTerpakai);
        
        // Recent activities
        $pengajuanTerbaru = PengajuanPembimbing::with(['mahasiswa', 'dosen'])
            ->latest()
            ->take(10)
            ->get();
        
        // Pending quota requests
        $kuotaPending = PengajuanKuota::where('status', 'pending')
            ->with('dosen')
            ->latest()
            ->take(5)
            ->get();

        return view('kaprodi.dashboard', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalBimbinganAktif',
            'pengajuanPending',
            'totalKuota',
            'kuotaTerpakai',
            'kuotaTersisa',
            'pengajuanTerbaru',
            'kuotaPending'
        ));
    }
}
