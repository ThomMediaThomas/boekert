<?php

namespace App\Services;

use App\Booking;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DateTime;

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

    /**
     * @param Request $request
     * @param $customerId
     * @return Booking
     */
    public function createWithCustomer (Request $request, $customerId)
    {
        $booking = new Booking();
        $booking->boekert_id = $this->generateBoekertId();

        //@TODO NOT WORKING SAVE DATES
        $dateFrom = DateTime::createFromFormat('d-m-Y', $request->date_from);
        $booking->date_from = $dateFrom->format('Y-m-d H:i:s');
        $dateTo = DateTime::createFromFormat('d-m-Y', $request->date_to);
        $booking->date_to = $dateTo->format('Y-m-d H:i:s');

        $booking->type = $request->type;
        if ($request->type == 'chalet') {
            $booking->chalet_type = $request->chalet_type;
        } else {
            $booking->camping_type = $request->camping_type;
        }

        $booking->customer_id = $customerId;

        $booking->save();
        return $booking;
    }
}
