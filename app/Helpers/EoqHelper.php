<?php

use App\Models\EoqResult;
use App\Models\EOQSetting;
use App\Models\Product;
use App\Models\StockOut;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $month_year = explode('-', $bulanIni);
        $startDate = $now->copy()->subMonths(5)->startOfMonth();
        $endDate = $now->copy()->endOfMonth();
        $cost = EOQSetting::first();
        if (!$cost) {
            return false;
        }
        $products = Product::all();
        $check_exist = EoqResult::whereMonth('date', $month_year[1])
            ->whereYear('date', $month_year[0])
            ->exists();
        if ($check_exist) {
            return false;
        }
        DB::table('eoq_results')->truncate();
        foreach ($products as $index => $product) {
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
            $stockOutIds = $stockOuts->pluck('id')->toArray();
            $eoq_result[$index] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'D' => $D,
                'max' => $max,
                'average' => $average,
                'eoq' => $eoq,
                'rop' => $rop,
                'ss' => $ss,
                'frequency' => $frequency,
                'stock_out_id' => $stockOutIds
            ];

            EoqResult::create([
                'product_id' => $product->id,
                'total_demand' => $D,
                'max' => $max,
                'average' => $average,
                'eoq' => $eoq,
                'reorder_point' => $rop,
                'safety_stock' => $ss,
                'frequency' => $frequency,
                'stock_out_id' => $stockOutIds,
                'date' => Carbon::now()
            ]);
        }
        return $eoq_result;
    }
}
