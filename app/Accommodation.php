<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $includes = [
        'type',
        'chalet_type',
        'camping_type'
    ];

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

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeName($query, $value)
    {
        if ($value) {
            $likeValue = '%' . $value . '%';
            return $query
                ->where('name', 'like', $likeValue);
        } else {
            return $query;
        }
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeTypeId($query, $value)
    {
        if ($value) {
            return $query->where('type_id', $value);
        } else {
            return $query;
        }
    }

        /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSubTypeId($query, $value)
    {
        if ($value) {
            return $query->where('camping_type_id', $value)->orWhere('chalet_type_id', $value);
        } else {
            return $query;
        }
    }
}
