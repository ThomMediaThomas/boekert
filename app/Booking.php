<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'boekert_id',
        'date_from',
        'date_to',
        'type',
        'chalet_type',
        'camping_type',
        'customer_id',
        'created_at',
        'updated_at'
    ];

    protected $includes = [
        'customer'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
