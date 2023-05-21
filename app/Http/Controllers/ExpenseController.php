<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense = expense::all();


    	return view('expense/view',
                        [
                            'expense' => $expense,
                        ]
                    );
    }

        // untuk mendapatkan data expense
    public function fetchexpense()
        {
            $expense = Expense::all();
            return response()->json([
                'expense'=>$expense,
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
    public function store(StoreExpenseRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required',
                'amount' => 'required',
                'description' => 'required',
                'category' => 'required',
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
                Expense::create($request->all());
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }else{
                // update ke db
                $expense = Expense::find($request->input('idexpensehidden'));

                // proses update dari inputan form data
                $expense->date = $request->input('date');
                $expense->amount = $request->input('amount');
                $expense->description = $request->input('description');
                $expense->category = $request->input('category');
                $expense->wallet = $request->input('wallet');
                $expense->update(); //proses update ke db

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
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expense = Expense::find($id);
        if($expense)
        {
            return response()->json([
                'status'=>200,
                'expense'=> $expense,
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
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //hapus dari database
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return view('expense/view',
            [
                'expense' => $expense,
                'status_hapus' => 'Sukses Hapus'
            ]
        );
    }
}