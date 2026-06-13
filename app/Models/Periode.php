<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasilKeputusans()
    {
        return $this->hasMany(HasilKeputusan::class);
    }
}
