<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::with(['pengajuanPembimbing' => function($q) {
            $q->where('status', 'disetujui')->with('dosen');
        }]);
        
        // Filter by status if needed
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }
        
        $mahasiswas = $query->paginate(15);
        
        return view('kaprodi.mahasiswa.index', compact('mahasiswas'));
    }
}
