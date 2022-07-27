<?php

namespace App\Http\Controllers;

use App\Models\StockYard;
use App\Http\Requests\StoreStockYardRequest;
use App\Http\Requests\UpdateStockYardRequest;

class StockYardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stockyards = StockYard::all();
        return view('stockyard.index')->with('stockyards', $stockyards);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stockyard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStockYardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockYardRequest $request)
    {
        $name = $request->input('name');

        StockYard::create([
            'name' => $name,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockYard  $stockYard
     * @return \Illuminate\Http\Response
     */
    public function show(StockYard $stockYard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockYard  $stockYard
     * @return \Illuminate\Http\Response
     */
    public function edit(StockYard $stockYard)
    {
        return view('stockyard.edit')->with('stockyard', $stockYard);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockYardRequest  $request
     * @param  \App\Models\StockYard  $stockYard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockYardRequest $request, StockYard $stockYard)
    {
        $name = $request->input('name');
        $stockYard->update(['name' => $name]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockYard  $stockYard
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockYard $stockYard)
    {
        $stockYard->delete();
        return back();
    }
}
