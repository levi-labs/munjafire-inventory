<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EoqResult extends Model
{
    protected $table = 'eoq_results';
    protected $guarded = ['id'];
    protected $casts = [
        'stock_out_id' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
