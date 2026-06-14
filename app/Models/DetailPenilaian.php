<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    protected $guarded = ['id'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
