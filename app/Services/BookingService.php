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
    public function generateBoekertId()
    {
        $now = Carbon::now()->timestamp;
        $randomizer = Str::random(4);
        return 'B_' . $now . '_' . strtolower($randomizer);
    }

    /**
     * @param Request $request
     * @param $customerId
     * @return Booking
     */
    public function createWithCustomer(Request $request, $customerId)
    {
        $booking = new Booking();
        $booking->boekert_id = $this->generateBoekertId();

        $dateFrom = DateTime::createFromFormat('!d-m-Y', $request->date_from);
        $booking->date_from = $dateFrom->format('Y-m-d');
        $dateTo = DateTime::createFromFormat('!d-m-Y', $request->date_to);
        $booking->date_to = $dateTo->format('Y-m-d');

        $booking->type_id = $request->type_id;
        if ($request->type_id == 1) {
            $booking->chalet_type_id = $request->chalet_type_id;
            $booking->camping_type_id = null;
        }
        if ($request->type_id == 2) {
            $booking->camping_type_id = $request->camping_type_id;
            $booking->chalet_type_id = null;
        }

        $booking->accommodation_id = $request->accommodation_id;
        $booking->customer_id = $customerId;
        $booking->notes = $request->notes;
        $booking->source = $request->source;

        $booking->adults = $request->adults;
        $booking->children = $request->children;

        $booking->save();
        return $booking;
    }

    /**
     * @param Booking $booking
     * @param Request $request
     * @return Booking
     */
    public function update(Booking $booking, Request $request)
    {
        $dateFrom = DateTime::createFromFormat('!d-m-Y', $request->date_from);
        $booking->date_from = $dateFrom->format('Y-m-d');
        $dateTo = DateTime::createFromFormat('!d-m-Y', $request->date_to);
        $booking->date_to = $dateTo->format('Y-m-d');

        $booking->type_id = $request->type_id;
        if ($request->type_id == 1) {
            $booking->chalet_type_id = $request->chalet_type_id;
            $booking->camping_type_id = null;
        }
        if ($request->type_id == 2) {
            $booking->camping_type_id = $request->camping_type_id;
            $booking->chalet_type_id = null;
        }

        if ($request->accommodation_id == 0) {
            $booking->accommodation_id = null;
        } else {
            $booking->accommodation_id = $request->accommodation_id;
        }

        $booking->notes = $request->notes;
        $booking->source = $request->source;

        if ($request->checked_in) {
            if ($booking->checked_in != $request->checked_in) {
                $booking->checked_in_at = date('Y-m-d H:i:s');
            }

            $booking->checked_in = $request->checked_in;
        } else  {
            $booking->checked_in = 0;
        }

        if ($request->checked_out) {
            if ($booking->checked_out != $request->checked_out) {
                $booking->checked_out_at = date('Y-m-d H:i:s');
            }
            $booking->checked_out = $request->checked_out;
        } else  {
            $booking->checked_out = 0;
        }

        $booking->adults = $request->adults;
        $booking->children = $request->children;

        $booking->save();
        return $booking;
    }
}
