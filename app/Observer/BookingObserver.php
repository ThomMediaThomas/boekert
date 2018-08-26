<?php

namespace App\Observers;

use App\Booking;
use App\Services\BookingLogService;

class BookingObserver
{
    /**
     * @param Booking $booking
     */
    public function saved(Booking $booking)
    {
        $bookingLogService = app(BookingLogService::class);

        if ($booking->wasRecentlyCreated == true) {
            $bookingLogService->create('Boeking werd aangemaakt', $booking);
        } else {
            $changed = $booking->getDirty();
            $friendlyChanged = [];

            foreach($changed as $key => $value) {
                if ($key != 'updated_at' && $key != 'created_at') {
                    $friendlyChanged[] = $key . ' (nieuw: ' . $value . ')';
                }
            }

            $bookingLogService->create('<p>Wijzigingen in: <ul class="browser-default"><li>' . implode('</li><li>', $friendlyChanged), $booking) . '</li></ul></p>';
        }
    }
}
