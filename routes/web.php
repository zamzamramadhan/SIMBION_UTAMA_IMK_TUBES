<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $role = $user->role->name ?? 'mahasiswa';
    
    return match($role) {
        'admin' => redirect('/admin/dashboard'),
        'dosen' => redirect('/dosen/dashboard'),
        'kaprodi' => redirect('/kaprodi/dashboard'),
        'mahasiswa' => redirect('/mahasiswa/dashboard'),
        default => redirect('/mahasiswa/dashboard')
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Role-specific Dashboards
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/dosen/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])
    ->middleware(['auth', 'role:dosen'])
    ->name('dosen.dashboard');

Route::get('/kaprodi/dashboard', [\App\Http\Controllers\Kaprodi\DashboardController::class, 'index'])
    ->middleware(['auth', 'role:kaprodi'])
    ->name('kaprodi.dashboard');

Route::get('/mahasiswa/dashboard', [\App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])
    ->middleware(['auth', 'role:mahasiswa'])
    ->name('mahasiswa.dashboard');


Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('admin/dosen', \App\Http\Controllers\Admin\DosenController::class, ['names' => 'admin.dosen']);
    Route::get('/admin/mahasiswa/import', [\App\Http\Controllers\Admin\MahasiswaController::class, 'import'])->name('admin.mahasiswa.import');
    Route::post('/admin/mahasiswa/import', [\App\Http\Controllers\Admin\MahasiswaController::class, 'processImport'])->name('admin.mahasiswa.import.process');
    Route::resource('admin/mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class, ['names' => 'admin.mahasiswa']);
    
    // Pengajuan Kuota Admin
    Route::get('admin/pengajuan-kuota', [\App\Http\Controllers\Admin\PengajuanKuotaDosenController::class, 'index'])->name('admin.pengajuan.index');
    Route::put('admin/pengajuan-kuota/{pengajuanKuota}', [\App\Http\Controllers\Admin\PengajuanKuotaDosenController::class, 'update'])->name('admin.pengajuan.update');

    // Monitoring
    Route::get('admin/monitoring', [\App\Http\Controllers\Admin\MonitoringController::class, 'index'])->name('admin.monitoring.index');

    // Laporan
    Route::get('admin/laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('admin/laporan/export/mahasiswa', [\App\Http\Controllers\Admin\LaporanController::class, 'exportMahasiswa'])->name('admin.laporan.export.mahasiswa');
    Route::get('admin/laporan/export/bimbingan', [\App\Http\Controllers\Admin\LaporanController::class, 'exportBimbingan'])->name('admin.laporan.export.bimbingan');
    Route::get('admin/laporan/print', [\App\Http\Controllers\Admin\LaporanController::class, 'printBimbingan'])->name('admin.laporan.print');

    // Pengaturan & Logs
    Route::get('admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
    Route::get('admin/logs', [\App\Http\Controllers\Admin\LogController::class, 'index'])->name('admin.logs.index');
});

Route::middleware(['auth','role:dosen'])->group(function () {
   Route::resource('dosen/pengajuan', \App\Http\Controllers\Dosen\PengajuanKuotaController::class, ['names' => 'dosen.pengajuan'])->only(['index', 'create', 'store']);
   Route::resource('dosen/bimbingan', \App\Http\Controllers\Dosen\BimbinganController::class, ['names' => 'dosen.bimbingan'])->only(['index', 'update']);
});

Route::middleware(['auth','role:mahasiswa'])->group(function () {
    Route::resource('mahasiswa/pengajuan', \App\Http\Controllers\Mahasiswa\PengajuanController::class, ['names' => 'mahasiswa.pengajuan'])->only(['index', 'create', 'store']);
 });

Route::middleware(['auth','role:kaprodi'])->group(function () {
   Route::get('kaprodi/pengajuan-kuota', [\App\Http\Controllers\Kaprodi\PengajuanKuotaController::class, 'index'])->name('kaprodi.pengajuan.index');
   Route::put('kaprodi/pengajuan-kuota/{pengajuanKuota}', [\App\Http\Controllers\Kaprodi\PengajuanKuotaController::class, 'update'])->name('kaprodi.pengajuan.update');
   Route::get('kaprodi/dosen', [\App\Http\Controllers\Kaprodi\DosenController::class, 'index'])->name('kaprodi.dosen.index');
   Route::get('kaprodi/mahasiswa', [\App\Http\Controllers\Kaprodi\MahasiswaController::class, 'index'])->name('kaprodi.mahasiswa.index');
   Route::get('kaprodi/laporan', [\App\Http\Controllers\Kaprodi\LaporanController::class, 'index'])->name('kaprodi.laporan.index');
});

require __DIR__.'/auth.php';
