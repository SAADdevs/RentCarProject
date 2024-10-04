<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AdminResponsNotification;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class CarController extends Controller
{
    public function index()
    {
        $Cars = Car::all();
        return view("admin.cars.allCars",["cars"=> $Cars]);
    }

    public function edite($id)
    {
         $Car = Car::find($id);
         return view("admin.cars.editUserCar",["car"=> $Car]);
    }

    public function update(Request $request, $id)
    {
        $user = Car::find($id);
        $validatedData = $request->validate([
            'model' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'status' => 'required|in:rejected,approved,pending',
        ]);


        $user->update($validatedData);

        return redirect()->route('adminCars');
    }
    public function approveCar($id)
    {
        $status = 'approved';
        $car = Car::findOrFail($id);
        $car->status = $status;
        $car->availabilty_status = '1';
        $car->save();


        $owner = User::findOrFail($car->user_id);

        Notification::create([
            'user_id' => $owner->id,
            'message' => 'Admin approved your car with id ' . $car->id ,
            'is_read' => false
        ]);

        //admin notif
        Notification::create([
            'user_id' => Auth('')->id(),
            'message' => 'you approved car id ' . $car->id  ,
            'is_read' => false,
        ]);
        Mail::to($owner->email)->send(new AdminResponsNotification($car,$owner,$status));

        return redirect()->back()->with('success', 'Car approved successfully.');

    }

    public function rejectCar($id)
    {
        $status = 'rejected';
        $car = Car::findOrFail($id);
        $car->status = $status ;
        $car->save();

        $owner = User::findOrFail($car->user_id);

        Notification::create([
            'user_id' => $owner->id,
            'message' => 'Admin reject your car with id ' . $car->id ,
            'is_read' => false
        ]);

        //admin notif
        Notification::create([
            'user_id' => Auth('')->id(),
            'message' => 'you reject a car with id ' . $car->id  ,
            'is_read' => false,
        ]);
        Mail::to($owner->email)->send(new AdminResponsNotification($car,$owner,$status));


        return redirect()->back()->with('success', 'Car rejected successfully.');
    }

    public function deleteCar($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        $owner = User::findOrFail($car->user_id);

        Notification::create([
            'user_id' => $owner->id,
            'message' => 'Admin deleted your car with id ' . $car->id ,
            'is_read' => false
        ]);

        //admin notif
        Notification::create([
            'user_id' => Auth('')->id(),
            'message' => 'you deleted a car with id ' . $car->id  ,
            'is_read' => false,
        ]);
        return redirect()->back()->with('success', 'Car deleted successfully.');
    }
}
