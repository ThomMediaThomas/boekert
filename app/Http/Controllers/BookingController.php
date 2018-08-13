<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\Services\BookingService;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings/index', [ 'bookings' => $bookings ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookings/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create customer
        $customer = new Customer();
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->street = $request->street;
        $customer->housenumber = $request->housenumber;
        $customer->zip = $request->zip;
        $customer->city = $request->city;
        $customer->country = $request->country;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->save();

        //create booking
        $bookingService = app(BookingService::class);
        $booking = new Booking();
        $booking->boekert_id = $bookingService->generateBoekertId();

        //@TODO NOT WORKING SAVE DATES
        $dateFrom = DateTime::createFromFormat('d-m-Y', $request->date_from);
        $booking->date_from = $dateFrom->format('Y-m-d H:i:s');
        $dateTo = DateTime::createFromFormat('d-m-Y', $request->date_to);
        $booking->date_to = $dateTo->format('Y-m-d H:i:s');

        $booking->type = $request->type;
        if ($request->type == 'chalet') {
            $booking->chalet_type = $request->chalet_type;
        } else {
            $booking->camping_type = $request->camping_type;
        }
        $booking->customer_id = $customer->id;


        $booking->save();

        return redirect('bookings')->with('success', 'Boeking succesvol toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
