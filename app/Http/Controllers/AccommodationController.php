<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\AccommodationSubType;
use App\AccommodationType;
use App\Services\AccommodationService;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accommodations = Accommodation::whereNotNull('id');
        $filters = [];

        if ($request->get('name')) {
            $filters['name'] = $request->get('name');
            $accommodations->name($request->get('name'));
        }

        if ($request->get('type_id')) {
            $filters['type_id'] = $request->get('type_id');
            $accommodations->typeId($request->get('type_id'));
        }

        if ($request->get('subtype_id')) {
            $filters['subtype_id'] = $request->get('subtype_id');
            $accommodations->subTypeId($request->get('subtype_id'));
        }

        //get caccommodation-types
        $accommodationTypes = AccommodationType::all();
        $accommodationSubTypes = AccommodationSubType::all();

        return view('accommodations/index', [
            'accommodations' => $accommodations->get(),
            'filter' => $filters,
            'accommodation_types' => $accommodationTypes,
            'accommodation_subtypes' => $accommodationSubTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get caccommodation-types
        $accommodationTypes = AccommodationType::all();
        $accommodationChaletTypes = AccommodationSubType::where('parent_type_id', 1)->get();
        $accommodationCampingTypes = AccommodationSubType::where('parent_type_id', 2)->get();

        return view('accommodations/create', [
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
        $accommodationService = app(AccommodationService::class);
        $accommodation = $accommodationService->create($request);

        return redirect('accommodations/' . $accommodation->id . '/edit')->with('success', 'Accommodatie succesvol toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function show(Accommodation $accommodation)
    {
        return view('accommodations/edit', ['accommodation' => $accommodation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accommodation $accommodation)
    {
        //get caccommodation-types
        $accommodationTypes = AccommodationType::all();
        $accommodationChaletTypes = AccommodationSubType::where('parent_type_id', 1)->get();
        $accommodationCampingTypes = AccommodationSubType::where('parent_type_id', 2)->get();

        return view('accommodations/edit', [
            'accommodation' => $accommodation,
            'accommodation_types' => $accommodationTypes,
            'accommodation_chalet_types' => $accommodationChaletTypes,
            'accommodation_camping_types' => $accommodationCampingTypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        //create customer
        $accommodationService = app(AccommodationService::class);
        $accommodation = $accommodationService->update($accommodation, $request);

        return redirect('accommodations/' . $accommodation->id . '/edit')->with('success', 'Accommodatie succesvol aangepast');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();
        return redirect('accommodations')->with('success', 'Accommodatie succesvol verwijderd');
    }
}
