<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilKeputusan extends Model
{
    use HasFactory;
    
    protected $table = 'hasil_keputusans';
    protected $guarded = ['id'];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
