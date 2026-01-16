<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id',
        'jumlah',
        'alasan',
        'catatan',
        'status',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
