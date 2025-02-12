<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dktr = Dokter::latest()->paginate(5);
        return view('dktr.index', compact('dktr'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dktr.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idDokter' => 'required',
            'namaDokter' => 'required',
            'tanggalLahir' => 'required',
            'spesialisasi' => 'required',
            'lokasiPraktik' => 'required',
            'jamPraktik' => 'required',
        ]);
        Dokter::create($request->all());
        return redirect()->route('dktr.index')->with('success', 'Data berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dktr)
    {
        return view('dktr.show', compact('dktr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dktr)
    {
        return view('dktr.edit', compact('dktr'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dktr)
    {
        $request->validate([
            'idDokter' => 'required',
            'namaDokter' => 'required',
            'tanggalLahir' => 'required',
            'spesialisasi' => 'required',
            'lokasiPraktik' => 'required',
            'jamPraktik' => 'required',
        ]);
        $dktr->update($request->all());
        return redirect()->route('dktr.index')->with('success', 'Data berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dktr)
    {
        $dktr->delete();
        return redirect()->route('dktr.index')->with('success', 'Data berhasil di Hapus');
    }
}
