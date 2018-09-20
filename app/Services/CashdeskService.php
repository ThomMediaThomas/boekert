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

        $listTemplate = '<li><span class="label">%s x %s <span class="label-note">(à %s € per %s)</span></span><span class="price">%s €</span></li>';

        $html = '<ul class="price-detail">';

        //calculate base price
        if ($nights) {
            $basePrice = $accommodationPrice->price;
            $price = $nights * $basePrice;
            $html .= sprintf($listTemplate, $nights, 'nachten', $basePrice, 'nacht', $price);
        }

        if ($adults) {
            $adultPrice = $accommodationPrice->price_adult;
            $price = ($nights * $adults * $adultPrice);
            $html .= sprintf($listTemplate, $adults, 'volwassenen', $adultPrice, 'nacht', $price);
        }

        if ($children) {
            $childPrice = $accommodationPrice->price_child;
            $price = ($nights * $children * $childPrice);
            $html .= sprintf($listTemplate, $children, 'kinderen', $childPrice, 'nacht', $price);
        }

        //add extras
        $extras = $booking->extras;
        foreach ($extras as $extra) {
            $extraPrice = $this->getExtraPrice($booking, $extra);
            $amount = $extra->pivot->amount;

            if ($amount) {
                if ($extraPrice->price_night) {
                    $price = $nights * $extraPrice->price * $amount;
                    $html .= sprintf($listTemplate, $amount, $extra->name, $extraPrice->price, 'nacht', $price);
                }

                if ($extraPrice->price_stay) {
                    $price = $extraPrice->price * $amount;
                    $html .= sprintf($listTemplate, $amount, $extra->name, $extraPrice->price, 'verblijf', $price);
                }
            }
        }

        $html .= '<li class="total"><span class="label">TOTAAL:</span><span class="price">€ ' . $this->getTotal($booking) .'</span></li>';

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
            $extraPrice = $this->getExtraPrice($booking, $extra);

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
        $dateFrom = $this->getBookingDateFrom($booking);

        if ($booking->type->system_name == 'chalet')  {
            return AccommodationPrice::where('accommodation_subtype_id', $booking->chalet_type->id)
                ->where('date_from', '<=', $dateFrom)
                ->where('date_to', '>=', $dateFrom)
                ->first();
        } else {
            return AccommodationPrice::where('accommodation_subtype_id', $booking->camping_type->id)
                ->where('date_from', '<=', $dateFrom)
                ->where('date_to', '>=', $dateFrom)
                ->first();
        }
    }

    /**
     * @param Booking $booking
     * @return string
     */
    private function getBookingDateFrom (Booking $booking)
    {
        $dateFrom = DateTime::createFromFormat('!d-m-Y', $booking->date_from);
        return $dateFrom->format('Y-m-d');
    }

    /**
     * @param Booking $booking
     * @return string
     */
    private function getBookingDateTo (Booking $booking)
    {
        $dateTo = DateTime::createFromFormat('!d-m-Y', $booking->date_to);
        return $dateTo->format('Y-m-d');
    }

    /**
     * @param Booking $booking
     * @param Extra $extra
     * @return mixed
     */
    private function getExtraPrice(Booking $booking, Extra $extra)
    {
        $dateFrom = $this->getBookingDateFrom($booking);

        return ExtraPrice::where('extra_id', $extra->id)
            ->where('date_from', '<=', $dateFrom)
            ->where('date_to', '>=', $dateFrom)
            ->first();
    }
}
