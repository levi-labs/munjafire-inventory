<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportStockInController extends Controller
{
    public function index()
    {
        $title = 'Report Stock In';
        // Assuming you have a method to fetch stock in data

        return view('pages.report_stock_in.index', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);
        try {
            $title = 'Report Stock In';
            $from = $request->input('from');
            $to = $request->input('to');
            $stockin = new \App\Models\StockIn();
            $data = $stockin->getReport($from, $to);
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
            return view('pages.report_stock_in.print', compact('data', 'title', 'periode', 'from', 'to'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
