<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\PengajuanPembimbing;
use App\Models\PengajuanKuota;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = auth()->user()->dosen;
        
        if (!$dosen) {
            return redirect()->route('dashboard')->with('error', 'Data dosen tidak ditemukan.');
        }

        // Statistics
        $kuotaTersisa = $dosen->kuota;
        $totalBimbingan = PengajuanPembimbing::where('dosen_id', $dosen->id)
            ->where('status', 'disetujui')
            ->count();
        
        $kuotaTerpakai = $totalBimbingan;
        $kuotaTersisa = max(0, $dosen->kuota - $kuotaTerpakai);
        
        $pengajuanPending = PengajuanPembimbing::where('dosen_id', $dosen->id)
            ->where('status', 'pending')
            ->count();
        
        // Recent Submissions
        $pengajuanTerbaru = PengajuanPembimbing::where('dosen_id', $dosen->id)
            ->with('mahasiswa')
            ->latest()
            ->take(5)
            ->get();
            
        // Kuota Request History
        $riwayatKuota = PengajuanKuota::where('dosen_id', $dosen->id)
            ->latest()
            ->take(3)
            ->get();

        return view('dosen.dashboard', compact(
            'dosen',
            'kuotaTersisa', 
            'totalBimbingan',
            'kuotaTerpakai',
            'pengajuanPending',
            'pengajuanTerbaru',
            'riwayatKuota'
        ));
    }
}
