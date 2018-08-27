<?php

namespace App\Services;

use App\Booking;
use App\BookingLog;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DateTime;

class BookingLogService
{
    /**
     * @param $message
     * @param Booking $booking
     * @return bool
     */
    public function create($message, Booking $booking) {
        $log = new BookingLog();
        $log->log = $message;
        $log->booking_id = $booking->id;
        $log->user_id = \Auth::user()->id;
        $log->save();
        return $log;
    }
}
