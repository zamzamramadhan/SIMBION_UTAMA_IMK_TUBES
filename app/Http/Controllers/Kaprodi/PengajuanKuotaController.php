<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKuota;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class PengajuanKuotaController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanKuota::with('dosen')
            ->orderByRaw("FIELD(status, 'pending') DESC")
            ->latest()
            ->get();
        
        return view('kaprodi.pengajuan-kuota.index', compact('pengajuans'));
    }

    public function update(Request $request, PengajuanKuota $pengajuanKuota)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string|max:500'
        ]);

        $oldQuota = $pengajuanKuota->dosen->kuota;
        
        // Update request status
        $pengajuanKuota->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        // If approved, update dosen quota
        if ($request->status == 'disetujui') {
            $pengajuanKuota->dosen->update([
                'kuota' => $oldQuota + $pengajuanKuota->jumlah
            ]);
        }

        // Log activity
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'jenis' => $request->status == 'disetujui' ? 'Approve' : 'Reject',
            'detail' => 'Kaprodi ' . ($request->status == 'disetujui' ? 'menyetujui' : 'menolak') . ' pengajuan kuota dosen ' . $pengajuanKuota->dosen->nama,
            'status' => $request->status == 'disetujui' ? 'success' : 'warning'
        ]);

        return back()->with('success', 'Pengajuan kuota berhasil ' . ($request->status == 'disetujui' ? 'disetujui' : 'ditolak'));
    }
}
