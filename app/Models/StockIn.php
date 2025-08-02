<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockIn extends Model
{
    protected $guarded = ['id'];
    protected $table = 'stock_ins';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function getReport($from, $to)
    {
        try {
            if ($from !== null && $to !== null) {
                $data = DB::table('stock_ins')
                    ->join('products', 'stock_ins.product_id', '=', 'products.id')
                    ->select('stock_ins.*', 'products.name as product_name')
                    ->whereBetween('stock_ins.date', [$from, $to])
                    ->orderBy('stock_ins.date', 'desc')
                    ->get();
                return $data;
            } elseif ($from !== null && $to === null) {
                $data = DB::table('stock_ins')
                    ->join('products', 'stock_ins.product_id', '=', 'products.id')
                    ->select('stock_ins.*', 'products.name as product_name')
                    ->where('stock_ins.date', '>=', $from)
                    ->orderBy('stock_ins.date', 'desc')
                    ->get();
                return $data;
            } elseif ($from === null && $to !== null) {
                $data = DB::table('stock_ins')
                    ->join('products', 'stock_ins.product_id', '=', 'products.id')
                    ->select(
                        'stock_ins.*',
                        'products.name as product_name'
                    )
                    ->whereDate('stock_ins.date', '<=', $to)
                    ->orderBy('stock_ins.date', 'desc')
                    ->get();
                return $data;
            } else {
                $data = DB::table('stock_ins')
                    ->join('products', 'stock_ins.product_id', '=', 'products.id')
                    ->select('stock_ins.*', 'products.name as product_name')
                    ->orderBy('stock_ins.date', 'desc')
                    ->get();
                return $data;
            }
        } catch (\Exception $e) {
            throw new \Exception('Error fetching report data: ' . $e->getMessage());
        }
    }
}
