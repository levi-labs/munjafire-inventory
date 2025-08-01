<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $guarded = ['id'];
    protected $table = 'stock_outs';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
