<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestBookings = Booking::orderBy('created_at', 'DESC')->limit(5)->get();
        $bookingsArrivingToday = Booking::dateFrom(date('d-m-Y'))->orderBy('created_at', 'DESC')->limit(5)->get();
        $bookingsLeavingToday = Booking::dateTo(date('d-m-Y'))->orderBy('created_at', 'DESC')->limit(5)->get();
        $bookingsUnattached = Booking::accommodationId(null)->orderBy('created_at', 'DESC')->limit(5)->get();

        return view('home.index', [
            'latestBookings' => $latestBookings,
            'bookingsArrivingToday' => $bookingsArrivingToday,
            'bookingsLeavingToday' => $bookingsLeavingToday,
            'bookingsUnattached' => $bookingsUnattached
        ]);
    }
}
