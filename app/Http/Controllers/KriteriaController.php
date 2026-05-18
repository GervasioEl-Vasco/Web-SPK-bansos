<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::with('subKriterias')->orderBy('kode')->get();
        return view('kriteria.index', compact('kriterias'));
    }

    public function edit(Kriteria $kriteria)
    {
        $kriteria->load('subKriterias');
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $validated = $request->validate([
            'bobot' => 'required|numeric|min:0|max:1',
        ]);

        $kriteria->update($validated);

        // Pastikan total bobot = 1
        $totalBobot = Kriteria::sum('bobot');
        if (abs($totalBobot - 1.0) > 0.001) {
            return redirect()->route('kriteria.index')
                ->with('warning', 'Bobot kriteria berhasil diperbarui. Namun total bobot saat ini = ' . number_format($totalBobot * 100, 1) . '% (seharusnya 100%).');
        }

        return redirect()->route('kriteria.index')
            ->with('success', 'Bobot kriteria berhasil diperbarui.');
    }
}
