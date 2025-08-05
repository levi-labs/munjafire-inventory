<?php

namespace App\Http\Controllers;

use App\Models\EoqResult;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function eoq()
    {
        $datas = getEoq(1); // Assuming product ID 1 for demonstration
        if (!$datas) {
            return back()->with('info', 'This month/`s data has already been processed');
        } else {
            return back()->with('success', 'This month/`s data has already been processed');
        }
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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(EoqResult $eoqResult)
    {
        $title = 'Economic Order Quantity Detail';

        $stock_outs = StockOut::with('product')
            ->whereIn('id', $eoqResult->stock_out_id)
            ->get();

        return view('pages.eoq_result.show', compact('title', 'eoqResult', 'stock_outs'));
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
        $eoqResult->delete();

        return back()->with('success', 'EOQ Result data deleted successfully');
    }
}
