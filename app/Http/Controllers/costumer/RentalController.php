<?php
namespace App\Http\Controllers\costumer;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\User;

class RentalController extends Controller
{
    public function showRentalStatus()
{
    $customerId = Auth::id();
    $rentals = Rental::where('customer_id', $customerId)
    ->where(function ($query) {
        $query->where('end_date', '>', now())
              ->Where('status', 'ongoing')
              ->orWhere('status', 'pending');
    })
    ->with('car')
    ->get();

    return view('costumers.rentalStatus',['rentedCars'=> $rentals]);
}

    public  function index()
    {
        $rentals = Rental::with('car', 'car.owner', 'customer')->get();
        return view('admin.cars.allRentals', compact('rentals'));
    }

public function cancelRentals($id)
{
    $rental = Rental::findOrFail($id);
    $car = Car::findOrFail($rental->car_id);

    if ($rental->customer_id != Auth::id()) {
        return redirect()->route('rentStatus')->with('error', 'Unauthorized action.');
    }

    if ($rental->status == 'pending') {
        $rental->status = 'cancelled';
        $rental->save();
        $car->availabilty_status = '1';
        $car->save();
        $rental->delete();
        return redirect()->route('rentalStatus')->with('success', 'Rental request cancelled successfully.');
    }

    //admin notif
    $customer = Auth::user();
    $adminId = User::where('role', 'admin')->first()->id;
    Notification::create([
        'user_id' => $adminId,
        'message' => 'the customer ' .$customer->name . ' cancelled rental request for the car with id ' .$car->id ,
        'is_read' => false,
    ]);
    return redirect()->route('rentalStatus')->with('error', 'Cannot cancel this rental.');
}

}
