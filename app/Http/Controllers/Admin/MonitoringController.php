<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        // Fetch all dosens with their skills
        // We need to count 'disetujui' PengajuanPembimbing for each Dosen.
        // Assuming PengajuanPembimbing relationship exists on Dosen or we query manually.
        // Currently Dosen model doesn't have 'bimbingans' relationship explicit in previous steps?
        // Let's check Dosen model or just add it now. 
        // Or simpler: use withCount if relation exists.
        
        // Let's assume relation 'bimbingans' (hasMany PengajuanPembimbing) is needed.
        // I will add it to Dosen model first via separate tool or just use a closure here if I want to avoid editing model (but editing model is better).
        
        // For now, let's load dosens and Map.
        $dosens = Dosen::with('skills')->get()->map(function($dosen) {
             // Mocking usage for now because PengajuanPembimbing might not be fully populated/linked yet.
             // But valid logic:
             // $used = $dosen->bimbingans()->where('status', 'disetujui')->count();
             
             // Since PengajuanPembimbing table exists (from initial migration context), let's assuming I can query it.
             // I'll use DB query for performance or add relation.
             // Let's use direct query for safety if relation isn't guaranteed yet.
             
             $used = \App\Models\PengajuanPembimbing::where('dosen_id', $dosen->id)
                        ->where('status', 'disetujui')
                        ->count();
             
             $dosen->terpakai = $used;
             $dosen->sisa = $dosen->kuota - $used;
             $dosen->utilization = $dosen->kuota > 0 ? round(($used / $dosen->kuota) * 100, 1) : 0;
             
             return $dosen;
        });
        
        // Sort by Utilization Descending
        $dosens = $dosens->sortByDesc('utilization');

        return view('admin.monitoring.index', compact('dosens'));
    }
}
