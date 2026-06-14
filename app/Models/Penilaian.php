<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function detailPenilaians()
    {
        return $this->hasMany(DetailPenilaian::class);
    }
}
