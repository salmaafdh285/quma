<?php

namespace App\Http\Controllers;

use App\Models\FinancialStatements;
use App\Http\Requests\StoreFinancialStatementsRequest;
use App\Http\Requests\UpdateFinancialStatementsRequest;

class FinancialStatementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFinancialStatementsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialStatements $financialStatements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialStatements $financialStatements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFinancialStatementsRequest $request, FinancialStatements $financialStatements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialStatements $financialStatements)
    {
        //
    }
}
