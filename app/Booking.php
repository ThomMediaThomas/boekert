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

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeDateFrom($query, $value)
    {
        return $query->where('date_from', '>=', $value);
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeDateTo($query, $value)
    {
        return $query->where('date_to', '<=', $value);
    }

    /**
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     */
    public function scopeAllForPeriod($query, $from, $to)
    {
        $from = DateTime::createFromFormat('d-m-Y', $from);
        $to = DateTime::createFromFormat('d-m-Y', $to);

        return $query
            ->where(function ($query) use ($from, $to){
                $query
                    ->where('date_from', '>=', $from)
                    ->where('date_from', '<=', $to);
            })
            ->orWhere(function ($query) use ($from, $to){
                $query
                    ->where('date_to', '>=', $from)
                    ->where('date_to', '<=', $to);
            });
    }
}
