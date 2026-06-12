<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = ['periode_id', 'material_id', 'kriteria_id', 'nilai'];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
