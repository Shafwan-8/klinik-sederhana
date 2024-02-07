<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class MasterLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->search;
        if ($query != null){
            $services = Service::where('name', 'like', '%' . $query . '%')
                        ->orWhere('rates', 'like',  '%' . $query . '%')
                        ->paginate(10);
        }else{
            $services = Service::paginate(10)->withQueryString();
        }
        return view('home.content.master.layanan.index', [
            'title' => 'Trika Klinik | Daftar Layanan',
            'services' => $services,
            'active' => 'services'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uuid = Str::uuid()->toString();
        return view('home.content.master.layanan.create', [
            'title' => 'Trika Klinik | Tambah Layanan',
            'active' => 'services',
            'uuid' => $uuid,
        ]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'id' => '',
            'name' => 'required',
            'rates' => '',
            'payment_method' => 'required',
            'keterangan' => 'nullable'
        ]);

        Service::create($validatedData);

        return to_route('layanan.index')->with('success', 'Layanan Berhasil Ditambahkan!');
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