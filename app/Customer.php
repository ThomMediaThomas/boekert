<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'street',
        'housenumber',
        'zip',
        'city',
        'country',
        'phone',
        'e-mail',
    ];
}
