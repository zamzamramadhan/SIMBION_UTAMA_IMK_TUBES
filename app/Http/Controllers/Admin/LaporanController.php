<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengajuanPembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelWriter;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Dosen paling populer (by request count)
        $topDosens = Dosen::withCount('skills')->get()->map(function($d) {
            $d->total_requests = PengajuanPembimbing::where('dosen_id', $d->id)->count();
            return $d;
        })->sortByDesc('total_requests')->take(5);

        // 2. Status Bimbingan Stats
        $stats = [
            'pending' => PengajuanPembimbing::where('status', 'pending')->count(),
            'disetujui' => PengajuanPembimbing::where('status', 'disetujui')->count(),
            'ditolak' => PengajuanPembimbing::where('status', 'ditolak')->count(),
        ];

        // 3. Trend Pengajuan per Bulan (Current Year)
        $monthlyStats = PengajuanPembimbing::select(
            DB::raw('count(id) as count'), 
            DB::raw('MONTH(created_at) as month')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->pluck('count', 'month')->toArray();

        // Fill missing months with 0
        $chartData = [];
        for ($i=1; $i<=12; $i++) {
            $chartData[] = $monthlyStats[$i] ?? 0;
        }

        return view('admin.laporan.index', compact('topDosens', 'stats', 'chartData'));
    }

    public function exportMahasiswa()
    {
        $mahasiswas = Mahasiswa::with('user')->get();
        
        $writer = SimpleExcelWriter::streamDownload('laporan_mahasiswa.csv');
        
        foreach($mahasiswas as $m) {
            $writer->addRow([
                'NIM' => $m->nim,
                'Nama' => $m->nama,
                'Email' => $m->user->email ?? '-',
                'Angkatan' => $m->angkatan,
                'Status' => $m->status,
                'Dosen Pembimbing' => $m->dosen ? $m->dosen->nama : '-',
            ]);
        }

        return $writer->toBrowser();
    }

    public function exportBimbingan()
    {
        $bimbingans = PengajuanPembimbing::with(['mahasiswa', 'dosen'])->get();

        $writer = SimpleExcelWriter::streamDownload('laporan_bimbingan.csv');

        foreach($bimbingans as $b) {
            $writer->addRow([
                'Tanggal' => $b->created_at->format('Y-m-d H:i'),
                'Mahasiswa' => $b->mahasiswa->nama,
                'NIM' => $b->mahasiswa->nim,
                'Dosen' => $b->dosen->nama,
                'Judul' => $b->judul,
                'Status' => $b->status,
            ]);
        }

        return $writer->toBrowser();
    }

    public function printBimbingan()
    {
        $bimbingans = PengajuanPembimbing::with(['mahasiswa', 'dosen'])
                        ->where('status', 'disetujui')
                        ->get();
                        
        return view('admin.laporan.print', compact('bimbingans'));
    }
}
