<?php

namespace App\Http\Controllers;

use App\Models\Pengeluarann;
use App\Http\Requests\StorePengeluarannRequest;
use App\Http\Requests\UpdatePengeluarannRequest;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Validator;

class PengeluarannController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluarann = pengeluarann::all();
        $sumber = Pengeluarann::getViewSumber();
    
    	return view('pengeluarann/view',
                        [
                            'pengeluarann' => $pengeluarann,
                            'sumber' =>$sumber
                        ]
                    );
    }

        // untuk mendapatkan data Pengeluaran
    public function fetchpengeluarann()
        {
            $pengeluarann = Pengeluarann::all();
            return response()->json([
                'pengeluarann'=>$pengeluarann,
            ]);
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengeluarannRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'id_pengeluarann' => 'required',
                'tgl_pengeluaran' => 'required',
                'jumlah' => 'required',
                'id_sumber'=>'required',
            ]
        );

        if($validator->fails()){
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        }else{
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah

            if($request->input('tipeproses')=='tambah'){
                // simpan ke db
                Pengeluarann::create($request->all());
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                $pengeluarann = Pengeluarann::find($request->input('idpengeluarannhidden'));

                // proses update dari inputan form data
                $pengeluarann->id_pengeluaran = $request->input('id_pengeluaran');
                $pengeluarann->tgl_pengeluaran = $request->input('tgl_pengeluaran');
                $pengeluarann->jumlah = $request->input('jumlah');
                $pengeluarann->id_sumber = $request->input('id_sumber');
                $pengeluarann->update(); //proses update ke db

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Update Data',
                    ]
                );
            }
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(Pengeluarann $pengeluarann)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengeluarann = Pengeluarann::find($id);
        if($pengeluarann)
        {
            return response()->json([
                'status'=>200,
                'pengeluarann'=> $pengeluarann,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengeluarannRequest $request, Pengeluarann $pengeluarann)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $pengeluarann = Pengeluarann::findOrFail($id);
        $pengeluarann->delete();
        return view('pengeluarann/view',
            [
                'pengeluarann' => $pengeluarann,
                'status_hapus' => 'Sukses Hapus'
            ]
        );
    }
}