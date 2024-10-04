<?php

namespace App\Http\Controllers\ownerCar;
use App\Http\Controllers\Controller;

use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RentalResponsNotification;
use App\Models\Car;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class RentalRequestController extends Controller
{
    public function showRequests()
    {
        $id = Auth::user()->id;
        $rentalRequests = Rental::whereHas('car', function($query) use ($id) {
            $query->where('user_id', $id);
        })
        ->where(function ($query) {
            $query->where('status', 'pending')
                  ->orWhere('status', 'ongoing');
        })
        ->get();

        return view('owner.rentalRequest', compact('rentalRequests'));
    }

    public function approveRequest(Request $request)
    {
        $status = 'ongoing';
        $owner = Auth::user();
        $id = $request->request_id;

        $rental = Rental::findOrFail($id);
        $rental->status = $status;

        $customer = User::findOrFail($rental->customer_id);
        $car = Car::findOrFail($rental->car_id);
        $car->availabilty_status = '0' ;
        $rental->save();

        //owner notif
        Notification::create([
            'user_id' => auth('')->id(),
            'message' => 'Car ID ' . $rental->car_id . ' rented from ' . $rental->start_date . ' to ' . $rental->end_date . '.', // Ensure there is no trailing comma here
            'is_read' => false
        ]);

        //admin notif
        $adminId = User::where('role', 'admin')->first()->id;
        Notification::create([
            'user_id' => $adminId,
            'message' => 'the owner ' . $owner->name . ' approved car request by   ' .$customer->name ,
            'is_read' => false,
        ]);

        Mail::to($customer->email)->send(new RentalResponsNotification($car, $customer, $owner, $status));

        return redirect()->back()->with('success', 'Rental request approved.');
    }

    public function rejectRequest($id)
    {
        $status = 'rejected';
        $owner = Auth::user();
        $rental = Rental::findOrFail($id);
        $customer = User::findOrFail($rental->customer_id);
        $car = Car::findOrFail($rental->car_id);
        $car->availabilty_status = '0';

        $rental->status = $status;
        $rental->save();

        //owner notif
        Notification::create([
            'user_id' => auth("")->id(),
            'message' => 'Car ID ' . $rental->car_id . ' rejected.',
            'is_read' => false,
        ]);

        //admin notif
        $adminId = User::where('role', 'admin')->first()->id;
        Notification::create([
            'user_id' => $adminId,
            'message' => 'the owner ' . $owner->name . ' rejected car request by   ' .$customer->name ,
            'is_read' => false,
        ]);

        Mail::to($customer->email)->send(new RentalResponsNotification($car, $customer, $owner, $status));

        return redirect()->route('rentalRequests')->with('success', 'Rental request rejected successfully.');
    }

    public function CompleteRental($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->status === 'completed' || $rental->status === 'cancelled') {
            return redirect()->route('myRentalCars')->with('error', 'This rental is already processed.');
        }

        $rental->status = 'completed';
        $rental->save();

        $car = Car::findOrFail($rental->car_id);
        $car->availabilty_status = '1';
        $car->save();

        //owner notif
        Notification::create([
            'user_id' => auth("")->id(),
            'message' => 'Rental for Car ID ' . $rental->car_id . ' has been marked as completed.',
            'is_read' => false,
        ]);

        //admin notif
        $adminId = User::where('role', 'admin')->first()->id;
        $owner = Auth::user();
        Notification::create([
            'user_id' => $adminId,
            'message' => 'the car ownered  ' . $owner->name .'  with id ' .$car->id . ' is complated renting.  ' ,
            'is_read' => false,
        ]);


        return redirect()->route('myRentalCars')->with('success', 'Rental marked as completed successfully.');
    }

    public function CancelledRental($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->status === 'completed' || $rental->status === 'cancelled') {
            return redirect()->route('myRentalCars')->with('error', 'This rental is already processed.');
        }

        $rental->status = 'cancelled';
        $rental->save();

        $car = Car::findOrFail($rental->car_id);
        $car->availabilty_status = '1';
        $car->save();
        //owner notif
        Notification::create([
            'user_id' => auth("")->id(),
            'message' => 'Rental for Car ID ' . $rental->car_id . ' has been cancelled.',
            'is_read' => false,
        ]);
        //admin notif
        $adminId = User::where('role', 'admin')->first()->id;
        $owner = Auth::user();
        Notification::create([
            'user_id' => $adminId,
            'message' => 'the car with id by ' . $car->id . ' is cancelled renting by owner   ' .$owner->name,
            'is_read' => false,
        ]);


        return redirect()->route('myRentalCars')->with('success', 'Rental marked as cancelled successfully.');
    }


}
