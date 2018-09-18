<?php

namespace App;

use App\Observers\BookingObserver;
use DateInterval;
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
        'accommodation',
        'booking_logs',
        'type',
        'chalet_type',
        'camping_type',
        'extras'
    ];

    protected $dispatchesEvents = [
        'saved' => BookingObserver::class
    ];

    public function getDateFromAttribute($value)
    {
        $dateFrom = DateTime::createFromFormat('!Y-m-d', $value);
        return $dateFrom->format('d-m-Y');
    }

    public function getDateToAttribute($value)
    {
        $dateTo = DateTime::createFromFormat('!Y-m-d', $value);
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

    public function type()
    {
        return $this->belongsTo(AccommodationType::class);
    }

    public function camping_type()
    {
        return $this->belongsTo(AccommodationSubType::class);
    }

    public function chalet_type()
    {
        return $this->belongsTo(AccommodationSubType::class);
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class)->withPivot('amount');
    }

    public function booking_logs()
    {
        return $this->hasMany(BookingLog::class)->orderBy('created_at', 'DESC');
    }

    /**
     * @param $query
     * @param $value
     * @return $query
     */
    public function scopeTextSearch($query, $value)
    {
        if ($value) {
            $likeValue = '%' . $value . '%';
            return $query
                ->join('customers', 'bookings.customer_id', '=', 'customers.id')
                ->where('customers.firstname', 'like', $likeValue)
                ->orWhere('customers.lastname', 'like', $likeValue)
                ->orWhere('customers.email', 'like', $likeValue)
                ->orWhere('customers.phone', 'like', $likeValue)
                ->orWhere('boekert_id', 'like', $likeValue);
        } else {
            return $query;
        }
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeBoekertId($query, $value) {
        if ($value) {
            $likeValue = '%' . $value . '%';
            return $query->where('boekert_id', 'like', $likeValue);
        } else {
            return $query;
        }
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeDateFrom($query, $value)
    {
        $from = DateTime::createFromFormat('d-m-Y', $value);
        return $query->where('date_from', $from->format('Y-m-d'));
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeDateTo($query, $value)
    {
        $to = DateTime::createFromFormat('d-m-Y', $value);
        return $query->where('date_to', $to->format('Y-m-d'));
    }


    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeType($query, $value) {
        if ($value && $value != 'all') {
            return $query->where('type', $value);
        } else {
            return $query;
        }
    }

    /**
     * @param $query
     * @param $from
     * @param $to
     * @return mixed
     */
    public function scopeAllForPeriod($query, $from, $to, $includeFromAndTo = true)
    {
        $from = DateTime::createFromFormat('d-m-Y', $from);
        $to = DateTime::createFromFormat('d-m-Y', $to);

        if (!$includeFromAndTo) {
            $from->add(new DateInterval('P1D'));
            $to->sub(new DateInterval('P1D'));
        }

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

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeCustomer($query, $value) {
        if ($value) {
            $likeValue = '%' . $value . '%';

            return $query
                ->join('customers', 'bookings.customer_id', '=', 'customers.id')
                ->where('customers.firstname', 'like', $likeValue)
                ->orWhere('customers.lastname', 'like', $likeValue)
                ->orWhere('customers.email', 'like', $likeValue)
                ->orWhere('customers.phone', 'like', $likeValue);
        } else {
            return $query;
        }
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeAccommodationId($query, $value) {
        return $query->where('accommodation_id', $value);
    }
}
