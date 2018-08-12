<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * @return string
     */
    public function generateBoekertId ()
    {
        $now = Carbon::now()->timestamp;
        $randomizer = Str::random(6);
        return 'B_' . $now . '_' . $randomizer;
    }
}
