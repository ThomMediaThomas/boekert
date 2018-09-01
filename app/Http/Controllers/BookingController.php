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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bookings = Booking::whereNotNull('boekert_id');
        $filters = [];

        if ($request->get('boekert_id')) {
            $filters['boekert_id'] = $request->get('boekert_id');
            $bookings->boekertId($request->get('boekert_id'));
        }

        if ($request->get('date_from')) {
            $filters['date_from'] = $request->get('date_from');
            $bookings->dateFrom($request->get('date_from'));
        }

        if ($request->get('date_to')) {
            $filters['date_to'] = $request->get('date_to');
            $bookings->dateTo($request->get('date_to'));
        }

        if ($request->get('customer')) {
            $filters['customer'] = $request->get('customer');
            $bookings->customer($request->get('customer'));
        }

        if ($request->get('text')) {
            $filters['text'] = $request->get('text');
            $bookings->textSearch($request->get('text'));
        }

        if ($request->get('type')) {
            $filters['type'] = $request->get('type');
            $bookings->type($request->get('type'));
        }


        return view('bookings/index', [
            'bookings' => $bookings->get(),
            'filter' => $filters
        ]);
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

        return redirect('bookings/' . $booking->id . '/edit')->with('success', 'Boeking succesvol toegevoegd');
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
     * @param $boekert_id
     * @return \Illuminate\Http\Response
     */
    public function editByBoekert($boekert_id)
    {
        $booking = Booking::where('boekert_id', $boekert_id)->first();
        if ($booking) {
            return $this->show($booking);
        } else {
            return $this->index(new Request);
        }
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

        return redirect('bookings/' . $booking->id . '/edit')->with('success', 'Booking succesvol aangepast');
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
