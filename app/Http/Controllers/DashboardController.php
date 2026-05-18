<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenduduk = Penduduk::count();
        $lastPeriode = Penilaian::max('periode') ?? date('Y');

        $totalLayak = Penilaian::where('periode', $lastPeriode)
            ->where('status', 'layak')->count();
        $totalTidakLayak = Penilaian::where('periode', $lastPeriode)
            ->where('status', 'tidak_layak')->count();
        $sudahDiproses = Penilaian::where('periode', $lastPeriode)->count();

        // Data untuk grafik kondisi rumah
        $kondisiRumahData = [
            Penduduk::where('kondisi_rumah', 1)->count(),
            Penduduk::where('kondisi_rumah', 2)->count(),
            Penduduk::where('kondisi_rumah', 3)->count(),
            Penduduk::where('kondisi_rumah', 4)->count(),
        ];

        // Data grafik penghasilan
        $penghasilanData = [
            Penduduk::where('penghasilan', '<=', 1000000)->count(),
            Penduduk::whereBetween('penghasilan', [1000001, 3000000])->count(),
            Penduduk::whereBetween('penghasilan', [3000001, 5000000])->count(),
            Penduduk::where('penghasilan', '>', 5000000)->count(),
        ];

        // Top 5 penerima layak
        $topPenerima = Penilaian::with('penduduk')
            ->where('periode', $lastPeriode)
            ->where('status', 'layak')
            ->orderBy('ranking')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalPenduduk', 'totalLayak', 'totalTidakLayak',
            'sudahDiproses', 'lastPeriode', 'kondisiRumahData',
            'penghasilanData', 'topPenerima'
        ));
    }
}
