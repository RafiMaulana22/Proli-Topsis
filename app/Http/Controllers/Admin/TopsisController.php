<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\HasilKeputusan;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::all();

        $kriteria = Kriteria::all();

        $penilaian = collect();

        $hasil = collect();

        $normalisasi = [];

        $terbobot = [];

        $aplus = [];

        $amin = [];

        if ($request->periode_id) {
            $penilaian = Penilaian::with(['material', 'detailPenilaians'])
                ->where('periode_id', $request->periode_id)
                ->get();

            $hasil = HasilKeputusan::with('material')->where('periode_id', $request->periode_id)->orderBy('ranking')->get();

            if ($penilaian->count() > 0) {
                $matrix = [];

                foreach ($penilaian as $p) {
                    foreach ($kriteria as $k) {
                        $detail = $p->detailPenilaians->where('kriteria_id', $k->id)->first();

                        $matrix[$p->id][$k->id] = $detail->nilai ?? 0;
                    }
                }

                $pembagi = [];

                foreach ($kriteria as $k) {
                    $sum = 0;

                    foreach ($penilaian as $p) {
                        $sum += pow($matrix[$p->id][$k->id], 2);
                    }

                    $pembagi[$k->id] = sqrt($sum);
                }

                foreach ($penilaian as $p) {
                    foreach ($kriteria as $k) {
                        $normalisasi[$p->id][$k->id] = $pembagi[$k->id] == 0 ? 0 : $matrix[$p->id][$k->id] / $pembagi[$k->id];
                    }
                }

                foreach ($penilaian as $p) {
                    foreach ($kriteria as $k) {
                        $terbobot[$p->id][$k->id] = $normalisasi[$p->id][$k->id] * ($k->bobot / 100);
                    }
                }

                foreach ($kriteria as $k) {
                    $kolom = [];

                    foreach ($penilaian as $p) {
                        $kolom[] = $terbobot[$p->id][$k->id];
                    }

                    if ($k->atribut == 'benefit') {
                        $aplus[$k->id] = max($kolom);

                        $amin[$k->id] = min($kolom);
                    } else {
                        $aplus[$k->id] = min($kolom);

                        $amin[$k->id] = max($kolom);
                    }
                }
            }
        }

        return view('Admin.Topsis.topsis_view', compact('periode', 'kriteria', 'penilaian', 'hasil', 'normalisasi', 'terbobot', 'aplus', 'amin'));
    }

    public function proses(Request $request)
    {
        $periodeId = $request->periode_id;

        $kriteria = Kriteria::all();

        $penilaian = Penilaian::with(['material', 'detailPenilaians'])
            ->where('periode_id', $periodeId)
            ->get();

        if ($penilaian->count() == 0) {
            return back()->with('error', 'Data penilaian belum ada');
        }

        /*
        ========================
        Matriks Keputusan
        ========================
        */

        $matrix = [];

        foreach ($penilaian as $p) {
            foreach ($kriteria as $k) {
                $detail = $p->detailPenilaians->where('kriteria_id', $k->id)->first();

                $matrix[$p->id][$k->id] = $detail->nilai ?? 0;
            }
        }

        /*
        ========================
        Penyebut Normalisasi
        ========================
        */

        $pembagi = [];

        foreach ($kriteria as $k) {
            $sum = 0;

            foreach ($penilaian as $p) {
                $sum += pow($matrix[$p->id][$k->id], 2);
            }

            $pembagi[$k->id] = sqrt($sum);
        }

        /*
        ========================
        Normalisasi
        ========================
        */

        $normalisasi = [];

        foreach ($penilaian as $p) {
            foreach ($kriteria as $k) {
                $normalisasi[$p->id][$k->id] = $matrix[$p->id][$k->id] / $pembagi[$k->id];
            }
        }

        /*
        ========================
        Terbobot
        ========================
        */

        $terbobot = [];

        foreach ($penilaian as $p) {
            foreach ($kriteria as $k) {
                $terbobot[$p->id][$k->id] = $normalisasi[$p->id][$k->id] * ($k->bobot / 100);
            }
        }

        /*
        ========================
        A+ dan A-
        ========================
        */

        $aplus = [];
        $amin = [];

        foreach ($kriteria as $k) {
            $kolom = [];

            foreach ($penilaian as $p) {
                $kolom[] = $terbobot[$p->id][$k->id];
            }

            if ($k->atribut == 'benefit') {
                $aplus[$k->id] = max($kolom);
                $amin[$k->id] = min($kolom);
            } else {
                $aplus[$k->id] = min($kolom);
                $amin[$k->id] = max($kolom);
            }
        }

        /*
        ========================
        D+ dan D-
        ========================
        */

        $hasil = [];

        foreach ($penilaian as $p) {
            $dplus = 0;
            $dmin = 0;

            foreach ($kriteria as $k) {
                $dplus += pow($terbobot[$p->id][$k->id] - $aplus[$k->id], 2);

                $dmin += pow($terbobot[$p->id][$k->id] - $amin[$k->id], 2);
            }

            $dplus = sqrt($dplus);
            $dmin = sqrt($dmin);

            $preferensi = $dmin / ($dplus + $dmin);

            $hasil[] = [
                'material_id' => $p->material_id,
                'nilai' => $preferensi,
            ];
        }

        /*
        ========================
        Ranking
        ========================
        */

        usort($hasil, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        HasilKeputusan::where('periode_id', $periodeId)->delete();

        foreach ($hasil as $index => $item) {
            HasilKeputusan::create([
                'periode_id' => $periodeId,
                'material_id' => $item['material_id'],
                'nilai_preferensi' => $item['nilai'],
                'ranking' => $index + 1,
            ]);
        }

        return redirect()
            ->route('topsis.index', ['periode_id' => $periodeId])
            ->with('success', 'Perhitungan TOPSIS berhasil');
    }
}
