<?php

use App\Models\EOQSetting;
use App\Models\Product;
use App\Models\StockOut;
use Carbon\Carbon;

if (!function_exists('formatNumber')) {
    function formatNumber($number)
    {
        return explode('.', $number)[0];
    }
}

if (!function_exists(('formatRupiah'))) {
    function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('getEoq')) {
    function getEoq($product)
    {
        $D = null;
        $now = Carbon::now();
        $bulanIni = $now->format('Y-m');
        $startDate = $now->copy()->subMonths(5)->startOfMonth();
        $endDate = $now->copy()->endOfMonth();
        $cost = EOQSetting::first();
        if (!$cost) {
            return false;
        }
        $products = Product::all();
        foreach ($products as $index => $product) {
            // $exists = Eo::where('product_id', $product->id)
            //     ->whereBetween('date', [$startDate, $endDate])
            //     ->orderBy('date', 'asc')
            //     ->get();
            // if ($exists) {
            //     continue;
            // }
            $stockOuts = StockOut::where('product_id', $product->id)
                ->whereBetween('date', [$startDate, $endDate])
                ->get();

            $D = $stockOuts->sum('quantity');
            $S = $cost->ordering_cost;
            $H = $cost->storage_cost;
            $leadTime = round($cost->lead_time / 30, 3);
            $average = $stockOuts->average('quantity'); // Assuming 30 days in a month
            $max = $stockOuts->max('quantity');
            $eoq = round(sqrt((2 * $D * $S) / $H));
            $ss = round(($max - $average) * ($leadTime));
            $rop = $ss + ($average * $leadTime);
            $frequency = round($D / $eoq);
            foreach ($stockOuts as $stockOut) {

                $eoq_result[$index] = [

                    'product_id' => $stockOut->product_id,
                    'product_name' => $stockOut->product->name,
                    'D' => $D,
                    'max' => $max,
                    'average' => $average,
                    'eoq' => $eoq,
                    'rop' => $rop,
                    'ss' => $ss,
                    'frequency' => $frequency,
                ];
            }
        }
        return $eoq_result;
    }
}
