<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockOut extends Model
{
    protected $guarded = ['id'];
    protected $table = 'stock_outs';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function getReport($from, $to)
    {
        try {
            if ($from !== null && $to !== null) {
                $data = DB::table('stock_outs')
                    ->join('products', 'stock_outs.product_id', '=', 'products.id')
                    ->select('stock_outs.*', 'products.name as product_name')
                    ->whereBetween('stock_outs.date', [$from, $to])
                    ->orderBy('stock_outs.date', 'desc')
                    ->get();
                return $data;
            } elseif ($from !== null && $to === null) {
                $data = DB::table('stock_outs')
                    ->join('products', 'stock_outs.product_id', '=', 'products.id')
                    ->select('stock_outs.*', 'products.name as product_name')
                    ->where('stock_outs.date', '>=', $from)
                    ->orderBy('stock_outs.date', 'desc')
                    ->get();
                return $data;
            } elseif ($from === null && $to !== null) {
                $data = DB::table('stock_outs')
                    ->join('products', 'stock_outs.product_id', '=', 'products.id')
                    ->select(
                        'stock_outs.*',
                        'products.name as product_name'
                    )
                    ->whereDate('stock_outs.date', '<=', $to)
                    ->orderBy('stock_outs.date', 'desc')
                    ->get();
                return $data;
            } else {
                $data = DB::table('stock_outs')
                    ->join('products', 'stock_outs.product_id', '=', 'products.id')
                    ->select('stock_outs.*', 'products.name as product_name')
                    ->orderBy('stock_outs.date', 'desc')
                    ->get();
                return $data;
            }
        } catch (\Exception $e) {
            throw new \Exception('Error fetching report data: ' . $e->getMessage());
        }
    }
}
