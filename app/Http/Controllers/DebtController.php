<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use App\Http\Requests\StoreDebtRequest;
use App\Http\Requests\UpdateDebtRequest;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Validator;

class DebtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $debt = debt::all();


    	return view('debt/view',
                        [
                            'debt' => $debt,
                        ]
                    );
    }

        // untuk mendapatkan data debt
    public function fetchdebt()
        {
            $debt = Debt::all();
            return response()->json([
                'debt'=>$debt,
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
    public function store(StoreDebtRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'target_date' => 'required',
                'wallet' => 'required',
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
                Debt::create($request->all());
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                $debt = Debt::find($request->input('iddebthidden'));

                // proses update dari inputan form data
                $debt->name = $request->input('name');
                $debt->description = $request->input('description');
                $debt->amount = $request->input('amount');
                $debt->date = $request->input('date');
                $debt->target_date = $request->input('target_date');
                $debt->wallet = $request->input('wallet');
                $debt->update(); //proses update ke db

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
    public function show(Debt $debt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $debt = Debt::find($id);
        if($debt)
        {
            return response()->json([
                'status'=>200,
                'debt'=> $debt,
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
    public function update(UpdateDebtRequest $request, Debt $debt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $debt = Debt::findOrFail($id);
        $debt->delete();
        return view('debt/view',
            [
                'debt' => $debt,
                'status_hapus' => 'Sukses Hapus'
            ]
        );
    }
}