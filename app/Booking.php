<?php

namespace App;

use DateTime;
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
        'customer',
        'accommodation'
    ];

    public function getDateFromAttribute($value)
    {
        $dateFrom = DateTime::createFromFormat('Y-m-d', $value);
        return $dateFrom->format('d-m-Y');
    }

    public function getDateToAttribute($value)
    {
        $dateTo = DateTime::createFromFormat('Y-m-d', $value);
        return $dateTo->format('d-m-Y');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
