<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $periode = $request->get('periode', date('Y'));

        $periodes = Penilaian::select('periode')
            ->distinct()
            ->orderByDesc('periode')
            ->pluck('periode');

        $hasilSeleksi = Penilaian::with('penduduk')
            ->where('periode', $periode)
            ->orderBy('ranking')
            ->get();

        $totalLayak = $hasilSeleksi->where('status', 'layak')->count();
        $totalTidakLayak = $hasilSeleksi->where('status', 'tidak_layak')->count();

        return view('laporan.index', compact(
            'periode', 'periodes', 'hasilSeleksi', 'totalLayak', 'totalTidakLayak'
        ));
    }

    public function cetak(Request $request)
    {
        $periode = $request->get('periode', date('Y'));

        $hasilSeleksi = Penilaian::with('penduduk')
            ->where('periode', $periode)
            ->orderBy('ranking')
            ->get();

        $totalLayak = $hasilSeleksi->where('status', 'layak')->count();
        $totalTidakLayak = $hasilSeleksi->where('status', 'tidak_layak')->count();

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'periode', 'hasilSeleksi', 'totalLayak', 'totalTidakLayak'
        ))->setPaper('a4', 'portrait');

        return $pdf->download("laporan-seleksi-bansos-{$periode}.pdf");
    }
}
