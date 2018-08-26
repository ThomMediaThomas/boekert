<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingLog extends Model
{
    protected $fillable = [
        'user_id',
        'booking_id',
        'log'
    ];

    protected $includes = [
        'user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
