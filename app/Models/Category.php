<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];
    protected $table = 'categories';
    public $timestamps = false;


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value)
        );
    }
}
