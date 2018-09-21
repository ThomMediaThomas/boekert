<?php

namespace App\Observers;

use App\Booking;
use App\BookingExtra;
use App\Services\BookingLogService;

class BookingExtraObserver
{
    /**
     * @param BookingExtra $bookingExtra
     */
    public function saved(BookingExtra $bookingExtra)
    {
        $bookingLogService = app(BookingLogService::class);

        if ($bookingExtra->wasRecentlyCreated != true) {
            $booking = $bookingExtra->booking;
            $changed = $bookingExtra->getDirty();
            $friendlyChanged = [];

            foreach($changed as $key => $value) {
                if ($key != 'updated_at' && $key != 'created_at') {
                    $friendlyChanged[] = $bookingExtra->extra->name . '-' . $key . ' (nieuw: ' . $value . ')';
                }
            }

            if (count($friendlyChanged) > 0) {
                $bookingLogService->create('<p>Wijzigingen in: <ul class="browser-default"><li>' . implode('</li><li>', $friendlyChanged), $booking) . '</li></ul></p>';
            }
        }
    }
}
