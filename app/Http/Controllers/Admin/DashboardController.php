<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengajuanKuota;
use App\Models\PengajuanPembimbing;
use App\Models\LogAktivitas;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalDosen' => Dosen::count(),
            'dosenAktif' => Dosen::where('status','aktif')->count(),
            'dosenNonaktif' => Dosen::where('status','nonaktif')->count(),

            'totalMahasiswa' => Mahasiswa::count(),
            // Ensure status strings match what is in DB/Enum.
            'bimbinganAktif' => PengajuanPembimbing::where('status','disetujui')->count(),
            'pendingKuota' => PengajuanKuota::where('status','pending')->count(),

            'aktivitas' => LogAktivitas::latest()->limit(6)->get()
        ]);
    }
}
