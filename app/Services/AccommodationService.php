<?php

namespace App\Services;

use App\Accommodation;
use App\Booking;
use Illuminate\Http\Request;

class AccommodationService
{
    /**
     * @param Request $request
     * @return Accommodation
     */
    public function create(Request $request)
    {
        $accommodation = new Accommodation();

        $accommodation->name = $request->name;
        $accommodation->field_number = $request->field_number;

        $accommodation->type = $request->type;
        if ($request->type == 'chalet') {
            $accommodation->chalet_type = $request->chalet_type;
        } else {
            $accommodation->camping_type = $request->camping_type;
        }

        $accommodation->save();
        return $accommodation;
    }


    /**
     * @param Request $request
     * @return Accommodation
     */
    public function update(Accommodation $accommodation, Request $request)
    {
        $accommodation->name = $request->name;
        $accommodation->field_number = $request->field_number;

        $accommodation->type = $request->type;
        if ($request->type == 'chalet') {
            $accommodation->chalet_type = $request->chalet_type;
        } else {
            $accommodation->camping_type = $request->camping_type;
        }

        $accommodation->save();
        return $accommodation;
    }

    /**
     * @param Booking $booking
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAvailableAccommodationsForBooking(Booking $booking)
    {
        $accommodations = Accommodation::orderBy('name')->get();

        $mappedAccommodations = $accommodations->map(function ($accommodation, $key) use ($booking) {
            $bookedAccommodations = Booking::allForPeriod($booking->date_from, $booking->date_to)->pluck('accommodation_id');
            $rejects = 0;

            if ($booking->type != $accommodation->type) {
                $rejects++;
            }

            if ($booking->type == 'camping' && $booking->camping_type != 'tent' && $accommodation->camping_type == 'tent') {
                $rejects++;
            }

            if ($booking->type == 'chalet' && ($booking->chalet_type != $accommodation->chalet_type)) {
                $rejects++;
            }

            if ($accommodation->id != $booking->accommodation_id && in_array($accommodation->id, $bookedAccommodations->toArray())) {
                $rejects++;
            }

            $accommodation->available = $rejects == 0;
           return $accommodation;
        });

        return $mappedAccommodations;
    }
}
