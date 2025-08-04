<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportStockOutController extends Controller
{
    public function index()
    {
        $title = 'Report Stock Out';
        // Assuming you have a method to fetch stock in data

        return view('pages.report_stock_out.index', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);
        try {
            $title = 'Report Stock Out';
            $from = $request->input('from');
            $to = $request->input('to');
            $stockout = new \App\Models\StockOut();
            $data = $stockout->getReport($from, $to);
            $format_from = Carbon::parse($from)->format('d-F-Y');
            $format_to = Carbon::parse($to)->format('d-F-Y');
            if ($from !== null && $to !== null) {
                $periode = ' For the period ' . $format_from . ' - ' . $format_to;
            } elseif ($from !== null && $to === null) {
                $periode = ' For the period on or after ' . $format_from;
            } elseif ($from === null && $to !== null) {
                $periode = ' For the period on or before - ' . $format_to;
            } else {
                $periode = ' For the all data period ';
            }
            return view('pages.report_stock_out.print', compact('data', 'title', 'periode', 'from', 'to'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
