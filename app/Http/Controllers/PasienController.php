<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pasiens = Pasien::latest()
            ->when($search, function ($query, $search) {
                return $query->where('namaPasien', 'LIKE', "%{$search}%");
            })
            ->paginate(5);

        return view('pasien.index', compact('pasiens'))
            ->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('search', $search);  // Pass the search query back to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil daftar spesialisasi unik dari dokter
        $spesialisasi = Dokter::select('spesialisasi')->distinct()->pluck('spesialisasi');

        // Ambil semua kamar
        $kamar = Ruangan::all();

        // Ambil semua dokter
        $dokters = Dokter::all();

        return view('pasien.create', compact('spesialisasi', 'kamar', 'dokters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomorRekamMedis' => 'required|unique:pasiens,NomorRekamMedis',
            'namaPasien' => 'required|string|max:255',
            'tanggalLahir' => 'required|date',
            'jenisKelamin' => 'required|in:L,P',
            'alamatPasien' => 'required|string',
            'kotaPasien' => 'required|string',
            'dokter' => 'required|exists:dokters,idDokter',
            'tanggalMasuk' => 'required|date',
            'nomorKamar' => 'required|exists:ruangans,id',
        ]);

        // Hitung usia pasien
        $birthDate = new \DateTime($request->tanggalLahir);
        $today = new \DateTime();
        $usiaPasien = $today->diff($birthDate)->y;

        // Ambil spesialisasi dokter
        $dokter = Dokter::findOrFail($request->dokter);
        $penyakitPasien = $dokter->spesialisasi;

        // Cek ketersediaan kamar
        $kamar = Ruangan::findOrFail($request->kodeRuangan);
        if ($kamar->dayaTampung <= 0) {
            return redirect()->back()->withErrors(['nomorKamar' => 'Kamar penuh! Silakan pilih kamar lain.']);
        }

        // Simpan data pasien baru
        Pasien::create([
            'NomorRekamMedis' => $request->nomorRekamMedis,
            'namaPasien' => $request->namaPasien,
            'tanggalLahir' => $request->tanggalLahir,
            'jenisKelamin' => $request->jenisKelamin,
            'alamatPasien' => $request->alamatPasien,
            'kotaPasien' => $request->kotaPasien,
            'usiaPasien' => $usiaPasien,
            'penyakitPasien' => $penyakitPasien,
            'idDokter' => $request->dokter,
            'tanggalMasuk' => $request->tanggalMasuk,
            'nomorKamar' => $request->nomorKamar,
        ]);

        // Kurangi daya tampung kamar setelah pasien masuk
        $kamar->decrement('dayaTampung');

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
