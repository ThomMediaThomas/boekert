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
        return $this->getPriceSpecificationHtml($booking);
    }

    /**
     * @param Booking $booking
     * @return string
     */
    public function getPriceSpecificationHtml(Booking $booking)
    {
        $nights = $this->getNights($booking);
        $adults = $booking->adults;
        $children = $booking->children;

        $accommodationPrice = $this->getAccommodationPrice($booking);

        $html = '<ul>';

        //calculate base price
        $basePrice = $accommodationPrice->price;
        $price = $nights * $basePrice;
        $html .= '<li><span>' . $nights . ' nachten:</span><strong>€ ' . $price .'</strong></li>';

        $adultPrice = $accommodationPrice->price_adult;
        $price = ($nights * $adults * $adultPrice);
        $html .= '<li><span>' . $adults . ' volwassenen (pppn):</span><strong>€ ' . $price .'</strong></li>';

        $childPrice = $accommodationPrice->price_child;
        $price = ($nights * $children * $childPrice);
        $html .= '<li><span>' . $children . ' kinderen (pppn):</span><strong>€ ' . $price .'</strong></li>';

        //add extras
        $extras = $booking->extras;
        foreach ($extras as $extra) {
            $extraPrice = $this->getExtraPrice($extra);

            if ($extraPrice->price_night)  {
                $price = $nights * $extraPrice->price * $extra->pivot->amount;
                $html .= '<li><span>' . $extra->name . ' (pn):</span><strong>€ ' . $price .'</strong></li>';
            }

            if ($extraPrice->price_stay) {
                $price = $extraPrice->price * $extra->pivot->amount;
                $html .= '<li><span>' . $extra->name . ':</span><strong>€ ' . $price .'</strong></li>';
            }
        }

        $html .= '<li class="total"><span>TOTAAL:</span><strong>€ ' . $this->getTotal($booking) .'</strong></li>';

        $html .= '</ul>';

        return $html;
    }

    /**
     * @param Booking $booking
     * @return string
     */
    public function getTotal(Booking $booking)
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

        return $price;
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
