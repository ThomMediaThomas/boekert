<?php

namespace App\Services;

use App\Accommodation;
use Illuminate\Http\Request;

class AccommodationService
{

    public function create (Request $request)
    {
        $accomodation = new Accommodation();

        $accomodation->name = $request->name;
        $accomodation->field_number = $request->field_number;

        $accomodation->type = $request->type;
        if ($request->type == 'chalet') {
            $accomodation->chalet_type = $request->chalet_type;
        } else {
            $accomodation->camping_type = $request->camping_type;
        }

        $accomodation->save();
        return $accomodation;
    }
}
