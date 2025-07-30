<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = ['id'];
    protected $table = 'suppliers';

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => strtoupper($value),
            set: fn($value) => strtolower($value),
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn($value) => preg_replace('/\D/', '', $value), // Remove non-numeric characters
            set: fn($value) => preg_replace('/\D/', '', $value), // Store only numeric characters
        );
    }
}
