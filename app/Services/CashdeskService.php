<?php

namespace App\Services;

use App\Accommodation;
use App\AccommodationPrice;
use App\Booking;
use App\Extra;
use App\ExtraPrice;
use DateTime;
use Illuminate\Http\Request;

class CashdeskService
{
    /**
     * @param Booking $booking
     * @return string
     */
    public function calculateBookingPrice(Booking $booking)
    {
        $nights = $this->getNights($booking);
        $adults = $booking->adults;
        $children = $booking->children;

        $accommodationPrice = $this->getAccommodationPrice($booking);

        //calculate base price
        $basePrice = $accommodationPrice->price;
        $price = $nights * $basePrice;

        //add persons price
        $adultPrice = $accommodationPrice->price_adult;
        $childPrice = $accommodationPrice->price_child;
        $price = $price + ($nights * $adults * $adultPrice);
        $price = $price + ($nights * $children * $childPrice);

        //add extras
        $extras = $booking->extras;
        foreach ($extras as $extra) {
            $extraPrice = $this->getExtraPrice($extra);

            if ($extraPrice->price_night)  {
                $price = $price + ($nights * $extraPrice->price * $extra->pivot->amount);
            }

            if ($extraPrice->price_stay) {
                $price = $price + ($extraPrice->price * $extra->pivot->amount);
            }
        }

        return 'Prijs voor ' . $nights . ' nachten: ' . $price;
    }

    /**
     * @param Booking $booking
     * @return string
     */
    private function getNights(Booking $booking)
    {
        $from = DateTime::createFromFormat('!d-m-Y', $booking->date_from);
        $to = DateTime::createFromFormat('!d-m-Y', $booking->date_to);
        $diff = $to->diff($from);
        return $diff->format('%a');
    }

    /**
     * @param Booking $booking
     * @return mixed
     */
    private function getAccommodationPrice(Booking $booking)
    {
        if ($booking->type->system_name == 'chalet')  {
            return AccommodationPrice::where('accommodation_subtype_id', $booking->chalet_type->id)->first();
        } else {
            return AccommodationPrice::where('accommodation_subtype_id', $booking->camping_type->id)->first();
        }
    }

    /**
     * @param Extra $extra
     * @return mixed
     */
    private function getExtraPrice(Extra $extra)
    {
        return ExtraPrice::where('extra_id', $extra->id)->first();
    }
}
