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
}
