<?php

namespace App\Services;

use App\Customer;
use Illuminate\Http\Request;

class CustomerService
{

    /**
     * @param Request $request
     * @return Customer
     */
    public function create (Request $request)
    {
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
        return $customer;
    }

    /**
     * @param Customer $customer
     * @param Request $request
     * @return Customer
     */
    public function update (Customer $customer, Request $request)
    {
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
        return $customer;
    }
}
