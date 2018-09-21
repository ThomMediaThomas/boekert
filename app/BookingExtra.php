<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingExtra extends Model
{
    protected $table = 'booking_extra';

    protected $includes = [
        'extra'
    ];

    protected $fillable = [
        'booking_id',
        'extra_id',
        'amount'
    ];

    public function extra()
    {
        return $this->belongsTo(Extra::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
