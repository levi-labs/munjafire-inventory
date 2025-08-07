<?php

namespace App\Http\Controllers;

use App\Models\EoqResult;
use App\Models\StockOut;
use Illuminate\Http\Request;

class ReportEoqController extends Controller
{
    public function index()
    {
        $title = 'Report EOQ';
        $eoq_periodes = EoqResult::get()->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
        })->keys();
        // dd($eoq_periodes);
        return view('pages.report_eoq.index', compact(
            'title',
            'eoq_periodes'
        ));
    }

    public function store(Request $request)
    {
        $title = 'Report Result EOQ';
        $data = EoqResult::with('product')
            ->whereIn('date', $request->periodes)
            ->get();

        $results = $data->map(function ($eoq) {
            $stockoutIds = $eoq->stock_out_id; // Sudah array karena cast

            $totalQty = StockOut::whereIn('id', $stockoutIds)->sum('quantity');

            $eoq->total_stockout_quantity = $totalQty;

            return $eoq;
        });
        // dd($results);
        return view('pages.report_eoq.print', compact('title', 'results'));
    }
}
