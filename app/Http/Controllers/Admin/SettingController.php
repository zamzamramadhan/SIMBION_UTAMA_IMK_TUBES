<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'default_quota' => 'required|integer|min:1',
            'periode_pengajuan' => 'required|in:open,closed',
        ]);

        Setting::set('default_quota', $request->default_quota);
        Setting::set('periode_pengajuan', $request->periode_pengajuan);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}
