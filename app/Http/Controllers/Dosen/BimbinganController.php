<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\PengajuanPembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BimbinganController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Auth::user()->dosen;
        if(!$dosen) return redirect()->back();

        // Build query
        $query = PengajuanPembimbing::with('mahasiswa')
                        ->where('dosen_id', $dosen->id);
        
        // Filter by status if provided
        $statusFilter = $request->query('status');
        if ($statusFilter) {
            $query->where('status', $statusFilter);
            $pageTitle = $statusFilter == 'pending' ? 'Pengajuan Masuk' : 'Mahasiswa Bimbingan';
        } else {
            $pageTitle = 'Mahasiswa Bimbingan';
        }
        
        $pengajuans = $query->orderByRaw("FIELD(status, 'pending') DESC")
                           ->latest()
                           ->get();

        return view('dosen.bimbingan.index', compact('pengajuans', 'statusFilter', 'pageTitle'));
    }

    public function update(Request $request, PengajuanPembimbing $bimbingan)
    {
         $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $dosen = Auth::user()->dosen;
        if($bimbingan->dosen_id != $dosen->id) abort(403);

        if($request->status == 'disetujui') {
            // Check quota
            $used = PengajuanPembimbing::where('dosen_id', $dosen->id)
                        ->where('status', 'disetujui')
                        ->count();
            
            if ($used >= $dosen->kuota) {
                return back()->with('error', 'Kuota Anda sudah penuh. Tidak bisa menyetujui lagi.');
            }
        }

        $bimbingan->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
