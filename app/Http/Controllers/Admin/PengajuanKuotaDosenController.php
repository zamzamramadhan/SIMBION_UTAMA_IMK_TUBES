<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajuanKuotaDosenController extends Controller
{
    public function index()
    {
        // Pending first, then latest
        $pengajuans = PengajuanKuota::with('dosen')
            ->orderByRaw("FIELD(status, 'pending') DESC")
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            
        return view('admin.pengajuan-kuota.index', compact('pengajuans'));
    }

    public function update(Request $request, PengajuanKuota $pengajuanKuota)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $pengajuanKuota) {
            $pengajuanKuota->update([
                'status' => $request->status,
                'catatan' => $request->catatan
            ]);

            if ($request->status === 'disetujui') {
                $dosen = $pengajuanKuota->dosen;
                // Increment quota
                // Note: Logic is "Quota Diajukan" -> usually means "Add this amount" or "Set to this amount"?
                // PRD says "Kuota Diajukan". Assuming "Additional Quota" or "Total Quota".
                // Usually "Request Quota" means "I want to take more students", so I will ADD to max quota.
                // Or it could mean "Please set my limit to X".
                // Let's assume ADDITION for safety, or SET. 
                // Context: "Kuota Default Dosen" exists. 
                // Let's assume it increases the existing 'kuota' field in Dosen model.
                
                $dosen->kuota += $pengajuanKuota->jumlah; 
                $dosen->save();
            }
        });

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
