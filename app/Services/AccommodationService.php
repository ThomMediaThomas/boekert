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
        $accommodations = Accommodation::all();
        return $accommodations;
    }
}
