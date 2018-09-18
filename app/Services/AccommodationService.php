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

        $accommodation->type_id = $request->type_id;
        if ($request->type_id == 1) {
            $accommodation->chalet_type_id = $request->chalet_type_id;
            $accommodation->camping_type_id = null;
        }
        if ($request->type_id == 2) {
            $accommodation->camping_type_id = $request->camping_type_id;
            $accommodation->chalet_type_id = null;
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

        $accommodation->type_id = $request->type_id;
        if ($request->type_id == 1) {
            $accommodation->chalet_type_id = $request->chalet_type_id;
            $accommodation->camping_type_id = null;
        }
        if ($request->type_id == 2) {
            $accommodation->camping_type_id = $request->camping_type_id;
            $accommodation->chalet_type_id = null;
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
            $bookedAccommodations = Booking::allForPeriod($booking->date_from, $booking->date_to, false)->pluck('accommodation_id');
            $rejects = 0;

            if ($booking->type_id != $accommodation->type_id) {
                $rejects++;
            }

            if ($booking->type->system_name == 'camping' && $booking->camping_type && $booking->camping_type->system_name != 'tent' && $accommodation->camping_type && $accommodation->camping_type->system_name == 'tent') {
                $rejects++;
            }

            if ($booking->type->system_name == 'chalet' && ($booking->chalet_type_id != $accommodation->chalet_type_id)) {
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
