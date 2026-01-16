<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['user_id', 'nama', 'nidn', 'kuota', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'dosen_skill');
    }

    public function pengajuanPembimbing()
    {
        return $this->hasMany(PengajuanPembimbing::class);
    }
}
