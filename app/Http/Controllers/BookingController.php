<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Services\AccommodationService;
use App\Services\BookingService;
use App\Services\CustomerService;
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
        return view('bookings/index', ['bookings' => $bookings]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //create customer
        $customerService = app(CustomerService::class);
        $customer = $customerService->create($request);

        //create booking
        $bookingService = app(BookingService::class);
        $booking = $bookingService->createWithCustomer($request, $customer->id);

        return redirect('bookings')->with('success', 'Boeking succesvol toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //get accommodations
        $accommodationService = app(AccommodationService::class);
        $accommodations = $accommodationService->getAvailableAccommodationsForBooking($booking);
        return view('bookings/edit', ['booking' => $booking, 'accommodations' => $accommodations]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //get accommodations
        $accommodationService = app(AccommodationService::class);
        $accommodations = $accommodationService->getAvailableAccommodationsForBooking($booking);
        return view('bookings/edit', ['booking' => $booking, 'accommodations' => $accommodations]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //create customer
        $bookingService = app(BookingService::class);
        $booking = $bookingService->update($booking, $request);

        return redirect('bookings')->with('success', 'Booking succesvol aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect('bookings')->with('success', 'Boeking succesvol verwijderd');
    }
}
