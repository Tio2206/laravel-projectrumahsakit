<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $ruangan = Ruangan::latest()
            ->when($search, function ($query, $search) {
                return $query->where('namaRuangan', 'LIKE', "%{$search}%");
            })
            ->paginate(5);

        return view('ruangan.index', compact('ruangan'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('search', $search); // Pass the search query back to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodeRuangan' => 'required',
            'namaRuangan' => 'required',
            'dayaTampung' => 'required',
            'lokasi' => 'required',
        ]);
        Ruangan::create($request->all());
        return redirect()->route('ruangan.index')->with('success', 'Data berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        return view('ruangan.show', compact('ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kodeRuangan' => 'required',
            'namaRuangan' => 'required',
            'dayaTampung' => 'required',
            'lokasi' => 'required',
        ]);
        $ruangan->update($request->all());
        return redirect()->route('ruangan.index')->with('success', 'Data berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('ruangan.index')->with('success', 'Data berhasil di Hapus');
    }
}
