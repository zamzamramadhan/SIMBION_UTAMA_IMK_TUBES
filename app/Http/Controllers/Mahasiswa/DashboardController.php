<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PengajuanPembimbing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        
        if (!$mahasiswa) {
            return redirect()->route('dashboard')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Get submission status
        $pengajuan = PengajuanPembimbing::where('mahasiswa_id', $mahasiswa->id)
            ->with('dosen')
            ->latest()
            ->first();
        
        // Statistics
        $statusPengajuan = $pengajuan ? $pengajuan->status : 'belum_mengajukan';
        $dosenPembimbing = $pengajuan && $pengajuan->status == 'disetujui' ? $pengajuan->dosen : null;
        
        // Recent submissions history
        $riwayatPengajuan = PengajuanPembimbing::where('mahasiswa_id', $mahasiswa->id)
            ->with('dosen')
            ->latest()
            ->take(5)
            ->get();

        return view('mahasiswa.dashboard', compact(
            'mahasiswa',
            'pengajuan',
            'statusPengajuan',
            'dosenPembimbing',
            'riwayatPengajuan'
        ));
    }
}
