<?php

namespace App\Http\Controllers;

use App\Models\Daftar;
use App\Http\Requests\StoreDaftarRequest;
use App\Http\Requests\UpdateDaftarRequest;


use Illuminate\Foundation\Http\FormRequest;

class DaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //query data
         $daftar = Daftar::all();
         return view('daftar/view',
                     [
                         'daftar' => $daftar
                     ]
                   );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('daftar/create',
        [
            'id_daftar' => Daftar::getIdDaftar()
        ]
      );
            // return view('daftar/view');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDaftarRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'nama' => 'required|unique:daftar|max:255',
            'tipe' => 'required',
            'total'=> 'required',
        ]);

        // masukkan ke db
        Daftar::create($request->all());

        return redirect()->route('daftar.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     */
    public function show(Daftar $daftar)
    {
        // return view('daftar.show', compact('daftar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Daftar $daftar)
    {
        return view('daftar.edit', compact('daftar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDaftarRequest $request, Daftar $daftar)
    {
         //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
         $validated = $request->validate([
            'nama' => 'required|max:255',
            'tipe' => 'required',
            'total'=> 'required',
        ]);

        $daftar->update($validated);

        return redirect()->route('daftar.index')->with('success','Data Berhasil di Ubah');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $daftar = Daftar::findOrFail($id);
        $daftar->delete();

        return redirect()->route('daftar.index')->with('success','Data Berhasil di Hapus');
    }
}