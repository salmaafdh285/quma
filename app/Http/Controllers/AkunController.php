<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Http\Requests\StoreAkunRequest;
use App\Http\Requests\UpdateAkunRequest;

use Illuminate\Foundation\Http\FormRequest;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $akun = Akun::all();
        return view('akun/view',
                    [
                        'akun' => $akun
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // berikan kode akun secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        
        return view('akun/create',
                    [
                        'kode_akun' => Akun::getKodeAkun()
                    ]
                  );
        // return view('akun/view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAkunRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAkunRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'header_akun' => 'required|unique:akun|max:255',
            'nama_akun' => 'required',
        ]);

        // masukkan ke db
        Akun::create($request->all());
        
        return redirect()->route('akun.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        //
        return view('akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAkunRequest  $request
     * @param  \App\Models\AKun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAkunRequest $request, Akun $akun)
    {
        //
        return redirect()->route('akun.index')->with('success','Data Berhasil di Ubah');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */

    // public function destroy(Akun $akun)
    public function destroy($id)
    {
        //hapus dari database
        $akun = Akun::findOrFail($id);
        $akun->delete();

        return redirect()->route('akun.index')->with('success','Data Berhasil di Hapus');
    }
}
