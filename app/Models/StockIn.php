<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
