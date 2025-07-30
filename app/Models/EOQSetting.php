<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EOQSetting extends Model
{
    protected $guarded = ['id'];
    protected $table = 'eoq_settings';
    public $timestamps = false;

    /**
     * Get the EOQ value.
     *
     * @return float
     */
    // public function getEOQValue()
    // {
    //     return $this->eoq_value ?? 0.0;
    // }

    /**
     * Set the EOQ value.
     *
     * @param float $value
     */
    // public function setEOQValue(float $value)
    // {
    //     $this->eoq_value = $value;
    //     $this->save();
    // }
}
