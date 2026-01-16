<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\PengajuanPembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function index()
    {
         $mahasiswa = Auth::user()->mahasiswa;
         if(!$mahasiswa) {
             return redirect()->route('dashboard')->with('error', 'Profile mahasiswa belum aktif.');
         }

         $pengajuan = PengajuanPembimbing::where('mahasiswa_id', $mahasiswa->id)->latest()->first();
         
         return view('mahasiswa.pengajuan.index', compact('pengajuan'));
    }

    public function create()
    {
        $mahasiswa = Auth::user()->mahasiswa;
        
        // Cek jika sudah ada pengajuan pending atau disetujui (Active)
        // Adjust logic based on "Konflik Management: Deteksi mahasiswa ajukan >1 dosen" requirement.
        // Let's strict it: 1 active request.
        $activeRequest = PengajuanPembimbing::where('mahasiswa_id', $mahasiswa->id)
                            ->whereIn('status', ['pending', 'disetujui'])
                            ->exists();

        if ($activeRequest) {
            return redirect()->route('mahasiswa.pengajuan.index')->with('error', 'Anda sudah memiliki pengajuan aktif.');
        }

        // List Dosen yang kuotanya masih ada
        // Using "sisa" logic (kuota - disetujui_count) > 0
        // Or simpler: just list all, and let validation handle it.
        // For UX, filter availability.
        
        // This query might be expensive if many records, but okay for MVP.
        $dosens = Dosen::with('skills')->get()->filter(function($dosen) {
             $used = \App\Models\PengajuanPembimbing::where('dosen_id', $dosen->id)
                        ->where('status', 'disetujui')
                        ->count();
             return ($dosen->kuota - $used) > 0;
        });

        return view('mahasiswa.pengajuan.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'judul' => 'required|string|max:255',
            'proposal' => 'required|file|mimes:pdf,doc,docx|max:2048', // 2MB max
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        // Double check quota race condition (simple check)
        $dosen = Dosen::findOrFail($request->dosen_id);
        $used = \App\Models\PengajuanPembimbing::where('dosen_id', $dosen->id)
                    ->where('status', 'disetujui')
                    ->count();
        
        if (($dosen->kuota - $used) <= 0) {
            return back()->with('error', 'Kuota dosen tersebut sudah penuh.');
        }

        $path = $request->file('proposal')->store('proposals', 'public');

        PengajuanPembimbing::create([
            'mahasiswa_id' => $mahasiswa->id,
            'dosen_id' => $dosen->id,
            'judul' => $request->judul,
            'proposal' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.pengajuan.index')->with('success', 'Pengajuan pembimbing berhasil dikirim.');
    }
}
