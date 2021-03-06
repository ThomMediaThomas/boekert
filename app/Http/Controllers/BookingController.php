<?php

namespace App\Http\Controllers;

use App\AccommodationSubType;
use App\AccommodationType;
use App\Booking;
use App\Extra;
use App\Services\AccommodationService;
use App\Services\BookingService;
use App\Services\CashdeskService;
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

        if ($request->get('type_id')) {
            $filters['type_id'] = $request->get('type_id');
            $bookings->typeId($request->get('type_id'));
        }

        //get caccommodation-types
        $accommodationTypes = AccommodationType::all();
        $accommodationSubTypes = AccommodationSubType::all();

        return view('bookings/index', [
            'bookings' => $bookings->get(),
            'filter' => $filters,
            'accommodation_types' => $accommodationTypes,
            'accommodation_subtypes' => $accommodationSubTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get extras
        $extras = Extra::all();

        //get caccommodation-types
        $accommodationTypes = AccommodationType::all();
        $accommodationChaletTypes = AccommodationSubType::where('parent_type_id', 1)->get();
        $accommodationCampingTypes = AccommodationSubType::where('parent_type_id', 2)->get();

        return view('bookings/create', [
            'extras' => $extras,
            'accommodation_types' => $accommodationTypes,
            'accommodation_chalet_types' => $accommodationChaletTypes,
            'accommodation_camping_types' => $accommodationCampingTypes
        ]);
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
       return $this->edit($booking);
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

        //get extras
        $extras = Extra::all();

        $price = app(CashdeskService::class)->calculateBookingPrice($booking);

        //get caccommodation-types
        $accommodationTypes = AccommodationType::all();
        $accommodationChaletTypes = AccommodationSubType::where('parent_type_id', 1)->get();
        $accommodationCampingTypes = AccommodationSubType::where('parent_type_id', 2)->get();

        return view('bookings/edit', [
            'booking' => $booking,
            'extras' => $extras,
            'price' => $price,
            'accommodations' => $accommodations,
            'accommodation_types' => $accommodationTypes,
            'accommodation_chalet_types' => $accommodationChaletTypes,
            'accommodation_camping_types' => $accommodationCampingTypes
        ]);
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
