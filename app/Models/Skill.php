<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'category'];

    public function dosens()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_skill');
    }
}