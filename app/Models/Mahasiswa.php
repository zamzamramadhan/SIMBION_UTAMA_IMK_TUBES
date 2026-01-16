<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    //
    protected $fillable = ['user_id', 'nama', 'nim', 'angkatan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengajuanPembimbing()
    {
        return $this->hasMany(PengajuanPembimbing::class);
    }
}
