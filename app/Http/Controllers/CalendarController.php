<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentMonth = $request->month ? $request->month : date('n');
        $currentYear = $request->year ? $request->year : date('Y');
        $availableYears = [date('Y') - 1, date('Y'), date('Y') + 1, date('Y') + 2];

        $dates = $this->getDates($currentMonth, $currentYear);
        $bookingsForPeriod = Booking::allForPeriod($dates[0]['date'], $dates[count($dates)-1]['date'])->with('customer')->get();

        return view('calendar/index', [
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'availableYears' => $availableYears,
            'daysInMonth' => $dates,
            'accommodations' => Accommodation::orderBy('name')->get(),
            'bookings' => $bookingsForPeriod
        ]);
    }

    private function getDates($month, $year)
    {
        $list = [];
        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month)
                $list[] = [
                    'date' => date('d-m-Y', $time),
                    'date_short' => date('d', $time),
                    'day' => date('l', $time),
                    'day_short' => date('D', $time),
                    'today' => date('d-m-Y', $time) == date('d-m-Y'),
                    'weekend' => date('D', $time) == 'Sat' || date('D', $time) == 'Sun'
                ];
        }
        return $list;
    }
}
