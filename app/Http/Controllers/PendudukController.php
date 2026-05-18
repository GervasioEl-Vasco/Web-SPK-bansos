<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        $query = Penduduk::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nik', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%");
            });
        }

        $penduduks = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('penduduk.index', compact('penduduks'));
    }

    public function create()
    {
        return view('penduduk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik'               => 'required|string|size:16|unique:penduduks,nik',
            'nama'              => 'required|string|max:255',
            'alamat'            => 'required|string',
            'pekerjaan'         => 'required|string|max:255',
            'penghasilan'       => 'required|integer|min:0',
            'tanggungan'        => 'required|integer|min:0|max:20',
            'kondisi_rumah'     => 'required|integer|between:1,4',
            'luas_bangunan'     => 'required|integer|min:0',
            'jenis_lantai'      => 'required|integer|between:1,4',
            'sumber_penerangan' => 'required|integer|between:1,4',
            'kendaraan'         => 'required|integer|between:1,4',
        ]);

        Penduduk::create($validated);

        return redirect()->route('penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function show(Penduduk $penduduk)
    {
        $penduduk->load('penilaians.penduduk');
        return view('penduduk.show', compact('penduduk'));
    }

    public function edit(Penduduk $penduduk)
    {
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate([
            'nik'               => 'required|string|size:16|unique:penduduks,nik,' . $penduduk->id,
            'nama'              => 'required|string|max:255',
            'alamat'            => 'required|string',
            'pekerjaan'         => 'required|string|max:255',
            'penghasilan'       => 'required|integer|min:0',
            'tanggungan'        => 'required|integer|min:0|max:20',
            'kondisi_rumah'     => 'required|integer|between:1,4',
            'luas_bangunan'     => 'required|integer|min:0',
            'jenis_lantai'      => 'required|integer|between:1,4',
            'sumber_penerangan' => 'required|integer|between:1,4',
            'kendaraan'         => 'required|integer|between:1,4',
        ]);

        $penduduk->update($validated);

        return redirect()->route('penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus.');
    }
}
