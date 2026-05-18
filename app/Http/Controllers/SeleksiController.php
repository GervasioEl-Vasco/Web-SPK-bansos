<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penduduk;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    /**
     * Tampilkan halaman seleksi + form pilih periode
     */
    public function index(Request $request)
    {
        $periode = $request->get('periode', date('Y'));
        $kriterias = Kriteria::orderBy('kode')->get();

        // Cek apakah sudah ada hasil untuk periode ini
        $hasilSeleksi = Penilaian::with('penduduk')
            ->where('periode', $periode)
            ->orderBy('ranking')
            ->get();

        // Data normalisasi untuk ditampilkan (jika sudah proses)
        $detailNormalisasi = [];
        if ($hasilSeleksi->isNotEmpty()) {
            $detailNormalisasi = $this->getDetailNormalisasi($kriterias, $periode);
        }

        return view('seleksi.index', compact(
            'periode', 'kriterias', 'hasilSeleksi', 'detailNormalisasi'
        ));
    }

    /**
     * Proses SAW untuk periode tertentu
     */
    public function proses(Request $request)
    {
        $request->validate([
            'periode' => 'required|string|max:10',
        ]);

        $periode = $request->periode;
        $penduduks = Penduduk::all();

        if ($penduduks->isEmpty()) {
            return redirect()->route('seleksi.index')
                ->with('error', 'Tidak ada data penduduk untuk diproses.');
        }

        $kriterias = Kriteria::orderBy('kode')->get();

        // ============ STEP 1: Konversi nilai ke rating sub-kriteria ============
        $matriksX = [];
        foreach ($penduduks as $p) {
            $matriksX[$p->id] = $this->konversiNilai($p, $kriterias);
        }

        // ============ STEP 2: Normalisasi Matriks ============
        $matriksR = [];
        foreach ($kriterias as $k) {
            $kode = $k->kode;
            $nilaiKolom = array_column($matriksX, $kode);

            $maxVal = max($nilaiKolom);
            $minVal = min($nilaiKolom);

            foreach ($penduduks as $p) {
                $xij = $matriksX[$p->id][$kode];
                if ($k->sifat === 'benefit') {
                    $matriksR[$p->id][$kode] = ($maxVal > 0) ? $xij / $maxVal : 0;
                } else {
                    // cost
                    $matriksR[$p->id][$kode] = ($xij > 0) ? $minVal / $xij : 0;
                }
            }
        }

        // ============ STEP 3: Hitung Nilai Preferensi (Vi) ============
        $nilaiPreferensi = [];
        foreach ($penduduks as $p) {
            $vi = 0;
            foreach ($kriterias as $k) {
                $vi += $k->bobot * ($matriksR[$p->id][$k->kode] ?? 0);
            }
            $nilaiPreferensi[$p->id] = $vi;
        }

        // ============ STEP 4: Ranking ============
        arsort($nilaiPreferensi); // Nilai terbesar = ranking terbaik
        $ranking = 1;

        // Hapus penilaian sebelumnya untuk periode ini
        Penilaian::where('periode', $periode)->delete();

        foreach ($nilaiPreferensi as $pendudukId => $nilaiAkhir) {
            // Threshold: Top 50% dianggap layak
            $threshold = ceil($penduduks->count() * 0.5);
            $status = $ranking <= $threshold ? 'layak' : 'tidak_layak';

            Penilaian::create([
                'penduduk_id' => $pendudukId,
                'periode'     => $periode,
                'nilai_akhir' => round($nilaiAkhir, 6),
                'ranking'     => $ranking,
                'status'      => $status,
            ]);
            $ranking++;
        }

        return redirect()->route('seleksi.index', ['periode' => $periode])
            ->with('success', "Proses seleksi SAW periode $periode berhasil! Total " . $penduduks->count() . " penduduk diproses.");
    }

    /**
     * Konversi nilai data penduduk ke rating 1-4 berdasarkan sub-kriteria
     */
    private function konversiNilai(Penduduk $p, $kriterias): array
    {
        return [
            'C1' => $this->ratingPenghasilan($p->penghasilan),
            'C2' => $this->ratingTanggungan($p->tanggungan),
            'C3' => $p->kondisi_rumah,   // sudah 1-4
            'C4' => $this->ratingLuas($p->luas_bangunan),
            'C5' => $p->jenis_lantai,    // sudah 1-4
            'C6' => $p->sumber_penerangan, // sudah 1-4
            'C7' => $p->kendaraan,       // sudah 1-4
        ];
    }

    private function ratingPenghasilan(int $penghasilan): int
    {
        if ($penghasilan <= 1000000) return 1;
        if ($penghasilan <= 3000000) return 2;
        if ($penghasilan <= 5000000) return 3;
        return 4;
    }

    private function ratingTanggungan(int $tanggungan): int
    {
        if ($tanggungan <= 1) return 1;
        if ($tanggungan <= 2) return 2;
        if ($tanggungan <= 3) return 3;
        return 4;
    }

    private function ratingLuas(int $luas): int
    {
        if ($luas < 30) return 1;
        if ($luas <= 60) return 2;
        if ($luas <= 90) return 3;
        return 4;
    }

    /**
     * Ambil detail normalisasi untuk tampilan tabel
     */
    private function getDetailNormalisasi($kriterias, string $periode): array
    {
        $penduduks = Penduduk::all();
        $matriksX = [];
        foreach ($penduduks as $p) {
            $matriksX[$p->id] = $this->konversiNilai($p, $kriterias);
        }

        $matriksR = [];
        foreach ($kriterias as $k) {
            $kode = $k->kode;
            $nilaiKolom = array_column($matriksX, $kode);
            $maxVal = max($nilaiKolom);
            $minVal = min($nilaiKolom);

            foreach ($penduduks as $p) {
                $xij = $matriksX[$p->id][$kode];
                if ($k->sifat === 'benefit') {
                    $matriksR[$p->id][$kode] = ($maxVal > 0) ? round($xij / $maxVal, 4) : 0;
                } else {
                    $matriksR[$p->id][$kode] = ($xij > 0) ? round($minVal / $xij, 4) : 0;
                }
                $matriksR[$p->id]['xij'][$kode] = $xij;
            }
        }

        return [
            'penduduks' => $penduduks,
            'matriksX'  => $matriksX,
            'matriksR'  => $matriksR,
        ];
    }
}
