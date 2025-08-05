<?php

namespace App\Http\Controllers;

use App\Models\EoqResult;
use Illuminate\Http\Request;

class EoqResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Economic Order Quantity';

        $datas = EoqResult::all();

        return view('pages.eoq_result.index', compact('title', 'datas'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EoqResult $eoqResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EoqResult $eoqResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EoqResult $eoqResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EoqResult $eoqResult)
    {
        //
    }
}
