<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Icd;
use App\Models\Inspection;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InspectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        if(auth()->user()->dokter->first() && auth()->user()->role == 'dokter') {   // dokter yang lagi login saja bisa akses
            $dokter = auth()->user()->dokter->first();
            $inisial = $dokter->inisial;
            $patients = Patient::where('medical_record_numb', 'like', $inisial . '%')->latest()->get();
        } else {     
            $patients = Patient::latest()->get(); // bukan dokter yang bisa akses, ya admin lah yang bisa akses
        }

        return view('home.content.pemeriksaan.index', [
            'title' => 'Trika Klinik | Daftar Pasien',
            'patients' => $patients,
            'active' => 'pemeriksaan'
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $icds = Icd::all();
        $dokter = auth()->user()->dokter->first();
        // $inisial = Dokter::find($id)->latest()->first();
        $patient = Patient::where('id' ,$id)->latest()->first();
        $waktu = Carbon::setLocale('id');
        $waktu = Carbon::now()->format('j-M-Y');
        $inisial = $dokter->inisial;
        
        
        $inisial = strtoupper($inisial);
        $kode = $inisial.'-'.date("y").date("m").date("d");
        
            // Ambil nilai terakhir dari angka 001
            $lastNumber = Inspection::where('patient_id', $id)->latest()->first();
            if ($lastNumber === null) {
                // Jika tidak ada angka 001, buat angka 001
                $kode = $kode . str_pad(1, 3, '0', STR_PAD_LEFT);
                
            }else{
                
                $lastNumber = $lastNumber ? (int)substr($lastNumber->no_registrasi, -3) : 0;
                
                // Tambahkan 1 ke nilai terakhir dari angka 001
                $lastNumber++;
                
                // Buat kode baru dengan menambahkan angka 001 ke kode lama
                $kode = $kode . str_pad($lastNumber, 3, '0', STR_PAD_LEFT);
            }
        // Simpan kode baru ke database
        // Inspection::create([
        //     'no_registrasi' => $kodeBaru 
        // ]);

        return view('home.content.pemeriksaan.tambah', [
            'title' => 'Trika Klinik | Tambah Riwayat Pemeriksaan',
            'patient' => $patient,
            'kode' => $kode,
            'waktu' => $waktu,
            // 'icds' => $icd,
            'active' => 'pemeriksaan'
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $data_lainnya = ($request->tindakan_lainnya);
        $diagnosa_lainnya = ($request->diagnosa_lainnya);
        // foreach ($request->tindakan_lainnya as $key => $value) {
            // $data_lainnya[] = $value;

            $request->request->add(['patient_id' => $id, 'no_registrasi' => $request->no_registrasi, 'tindakan_lainnya' => json_encode($data_lainnya), 'diagnosa_lainnya' => json_encode($diagnosa_lainnya)]);
            $validatedData = $request->validate([
                'td' => 'required',
                'suhu' => '',
                'nadi' => '',
                'so2' => '',
                'pernafasan' => '',
                'detail' => '',
                'tb' => '',
                'bb' => '',
                'subjektif' => '',
                'objektif' => '',
                'assesment' => '',
                'plan' => '',
                'diagnosa' => 'required',
                'diagnosa_lainnya' => '',
                'tindakan' => '',
                'harga_tindakan' => '',
                'tindakan_lainnya' => '',
                'patient_id' => '',
                'no_registrasi' => '',
            ]);

        // }

        Inspection::create($validatedData);

        return to_route('pemeriksaan.show', $id)->with('success', 'Riwayat Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $inspection = Inspection::where('patient_id', $id)->latest()->get();
        $patient = Patient::where('id', $id)->first();

        return view('home.content.pemeriksaan.pilih', [
            'title' => 'Trika Klinik | Riwayat Pemeriksaan',
            'inspections' => $inspection,
            'patient' => $patient,
            'active' => 'pemeriksaan',
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inspection = Inspection::find($id);
        $patient = Patient::find($inspection->patient_id);
        return view('home.content.pemeriksaan.edit', [
            'title' => 'Trika Klinik | Edit Riwayat',
            'patient' => $patient,
            'kode' => $inspection->no_registrasi,
            'inspection' => $inspection,
            'active' => 'pemeriksaan'
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inspection = Inspection::find($id);

        $validatedData = $request->validate([
            'td' => '',
            'suhu' => '',
            'nadi' => '',
            'so2' => '',
            'pernafasan' => '',
            'detail' => '',
            'tb' => '',
            'bb' => '',
            'subjektif' => '',
            'objektif' => '',
            'assesment' => '',
            'plan' => '',
            'diagnosa' => '',
            'tindakan' => '',
        ]);

        
        
        $inspection->update($validatedData);
        
        return to_route('pemeriksaan.show', $inspection->patient_id)->with('success', 'Riwayat Berhasil Diubah!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inspection = Inspection::find($id);        
        $inspection->delete();
        return redirect()->back()->with('success', 'Riwayat Berhasil Dihapus!');
    }
}
