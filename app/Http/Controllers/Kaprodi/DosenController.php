<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\PengajuanPembimbing;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('skills')
            ->withCount([
                'pengajuanPembimbing as total_bimbingan' => function($query) {
                    $query->where('status', 'disetujui');
                }
            ])
            ->get()
            ->map(function($dosen) {
                $dosen->kuota_tersisa = max(0, $dosen->kuota - $dosen->total_bimbingan);
                return $dosen;
            });
        
        return view('kaprodi.dosen.index', compact('dosens'));
    }
}
