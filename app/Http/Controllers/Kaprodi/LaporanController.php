<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengajuanPembimbing;
use App\Models\PengajuanKuota;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Overview Statistics
        $totalDosen = Dosen::where('status', 'aktif')->count();
        $totalMahasiswa = Mahasiswa::where('status', 'aktif')->count();
        
        // Bimbingan Statistics
        $totalBimbinganAktif = PengajuanPembimbing::where('status', 'disetujui')->count();
        $pengajuanPending = PengajuanPembimbing::where('status', 'pending')->count();
        $pengajuanDitolak = PengajuanPembimbing::where('status', 'ditolak')->count();
        
        // Kuota Statistics
        $totalKuota = Dosen::where('status', 'aktif')->sum('kuota');
        $kuotaTerpakai = $totalBimbinganAktif;
        $kuotaTersisa = max(0, $totalKuota - $kuotaTerpakai);
        $persentaseUtilisasi = $totalKuota > 0 ? round(($kuotaTerpakai / $totalKuota) * 100, 1) : 0;
        
        // Dosen dengan bimbingan terbanyak
        $dosenTopBimbingan = Dosen::withCount([
            'pengajuanPembimbing as total_bimbingan' => function($query) {
                $query->where('status', 'disetujui');
            }
        ])
        ->having('total_bimbingan', '>', 0)
        ->orderBy('total_bimbingan', 'desc')
        ->take(5)
        ->get();
        
        // Mahasiswa yang belum mendapat pembimbing
        $mahasiswaBelumPembimbing = Mahasiswa::where('status', 'aktif')
            ->whereDoesntHave('pengajuanPembimbing', function($query) {
                $query->where('status', 'disetujui');
            })
            ->count();
        
        // Recent Activities
        $aktivitasTerbaru = PengajuanPembimbing::with(['mahasiswa', 'dosen'])
            ->latest()
            ->take(10)
            ->get();

        return view('kaprodi.laporan.index', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalBimbinganAktif',
            'pengajuanPending',
            'pengajuanDitolak',
            'totalKuota',
            'kuotaTerpakai',
            'kuotaTersisa',
            'persentaseUtilisasi',
            'dosenTopBimbingan',
            'mahasiswaBelumPembimbing',
            'aktivitasTerbaru'
        ));
    }
}
