<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKuota;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanKuotaController extends Controller
{
    public function index()
    {
        $dosen = Auth::user()->dosen;
        
        if(!$dosen) {
             return redirect()->route('dashboard')->with('error', 'Profile dosen belum aktif.');
        }

        $pengajuans = PengajuanKuota::where('dosen_id', $dosen->id)->latest()->get();
        return view('dosen.pengajuan.index', compact('pengajuans', 'dosen'));
    }

    public function create()
    {
        return view('dosen.pengajuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'alasan' => 'required|string|max:500',
        ]);

        $dosen = Auth::user()->dosen;

        PengajuanKuota::create([
            'dosen_id' => $dosen->id,
            'jumlah' => $request->jumlah,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);
        
        // Log Activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'jenis' => 'Request',
            'detail' => 'Dosen ' . $dosen->nama . ' mengajukan kuota tambahan sebanyak ' . $request->jumlah,
            'status' => 'pending'
        ]);

        return redirect()->route('dosen.pengajuan.index')->with('success', 'Pengajuan kuota berhasil dikirim.');
    }
}
