<?php

namespace App\Http\Controllers\ownerCar;
use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Car;

class myCarsController extends Controller
{
    public function show()
    {
        $userId = auth("")->user()->id;

        $cars = Car::where('user_id', $userId)->get();

        return view('owner.AllMyCars', ['cars' => $cars]);
    }

    public function showCarRentals()
    {
        $rentals = Rental::with('car', 'customer')
                          ->where('status', 'ongoing')
                          ->get();

        return view('owner.CarRentals', ['rentals' => $rentals]);
    }



}

