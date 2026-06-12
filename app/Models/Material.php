<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['kode_material', 'nama_material', 'deskripsi', 'status'];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasilKeputusans()
    {
        return $this->hasMany(HasilKeputusan::class);
    }
}
