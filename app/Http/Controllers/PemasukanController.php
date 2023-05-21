<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Validator;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemasukan = Pemasukan::all();
        $sumber = Pemasukan::getViewSumber();
        
        
    	return view('pemasukan/view', 
                        [
                            'pemasukan' => $pemasukan,
                            'sumber'=> $sumber
                        ]
                    );
    }

    // untuk mendapatkan data pemasukan
    public function fetchpemasukan()
    {
        $pemasukan = Pemasukan::all();
        return response()->json([
            'pemasukan'=>$pemasukan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePemasukanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemasukanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'id_pemasukan' => 'required',
                'tgl_pemasukan' => 'required',
                'jumlah' => 'required',
                'id_sumber' => 'required',
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
                Pemasukan::create($request->all());
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Input Data Success',
                    ]
                );
            }else{
                // update ke db
                $pemasukan = Pemasukan::find($request->input('idpemasukanhidden'));
            
                // proses update dari inputan form data
                $pemasukan->id_pemasukan = $request->input('id_pemasukan');
                $pemasukan->tgl_pemasukan = $request->input('tgl_pemasukan');
                $pemasukan->jumlah = $request->input('jumlah');
                $pemasukan->id_sumber = $request->input('id_sumber');
                $pemasukan->update(); //proses update ke db

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Update Data Success',
                    ]
                );
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    // public function edit(Pemasukan $pemasukan)
    public function edit($id)
    {
        $pemasukan = Pemasukan::find($id);
        if($pemasukan)
        {
            return response()->json([
                'status'=>200,
                'pemasukan'=> $pemasukan,
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
     *
     * @param  \App\Http\Requests\UpdatePemasukanRequest  $request
     * @param  \App\Models\Pemasukan $pemasukan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePemasukanRequest $request, Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemasukan  $pemasukan
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Pemasukan $pemasukan)
    public function destroy($id)
    {
        //hapus dari database
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();
        return view('pemasukan/view',
            [
                'pemasukan' => $pemasukan,
                'status_hapus' => 'Delete Success'
            ]
        );
    }
}