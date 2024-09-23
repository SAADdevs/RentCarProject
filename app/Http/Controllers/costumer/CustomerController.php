<?php


namespace App\Http\Controllers\costumer;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use App\Mail\RentalRequestNotification;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class CustomerController extends Controller
{
    public function Index()
    {
        $availableCars = Car::where('availabilty_status', '1')
        ->where('status', 'approved')
        ->get();
        return view('costumers.costumer', compact('availableCars'));
    }

    public function searchCar(Request $request)
{
    $request->validate([
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'city' => 'nullable|string|max:255',
    ]);
    $query = Car::where('status', 'approved');

    if ($request->filled('city')) {
        $query->where('city', $request->city);
    }



    if ($request->filled('start_date') && $request->filled('end_date'))
    {
        if($request->input('start_date')>= $request->input('end_date'))
        {
            return redirect()->route('costumers')->withErrors(['there issue with dates please fille a correct dates .']);
        }
        //dd($request->start_date);
        $query->whereDoesntHave('rentals', function ($q) use ($request) {
            $q->where(function ($q) use ($request) {
                $q->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('start_date', '<=', $request->start_date)
                        ->where('end_date', '>=', $request->end_date);
                  });
            });
        });
    }

    $availableCars = $query->get();

    return view('costumers.costumer', compact('availableCars'));
}


    public function viewCarDetails($id)
    {
        $car = Car::findOrFail($id);

        $rental = Rental::where('car_id', $id)
                        ->where('status', 'ongoing')
                        ->where(function ($query) {
                            $query->where('start_date', '<=', now())
                            ->orWhere('end_date', '>=', now());
                        })
                        ->get();

        return view('costumers.carDetails', [
            'car' => $car,
            'rental' => $rental
        ]);
    }

    public function rentCar(Request $request, $id)
    {

        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);
        $car = Car::findOrFail($id);

        if ($car->availabilty_status !== '1') {
            return redirect()->route('costumers')->withErrors(['Car is not available for rent now.']);
        }
        $overlappingRentals = Rental::where('car_id', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('start_date', '<=', $request->start_date)
                                ->where('end_date', '>=', $request->end_date);
                      });
            })->exists();

        if ($overlappingRentals) {
            return redirect()->route('viewCarDetails',$car->id)->withErrors(['Car is already rented during the selected dates.']);
        }

        $rental = new Rental();
        $rental->car_id = $car->id;
        $rental->customer_id = Auth::id();
        $rental->start_date = $request->start_date;
        $rental->end_date = $request->end_date;
        $rental->status = 'pending';
        $rental->save();

        $car->save();
        $owner = $car->owner;
        $customer = Auth::user();

        //admin notif
       $adminId = User::where('role', 'admin')->first()->id;
       Notification::create([
           'user_id' => $adminId,
           'message' => 'the customer ' .$customer->name .'do a renting request to owner ' .$owner->name . 'for the car with id ' .$car->id,
           'is_read' => false,
       ]);
        Mail::to($owner->email)->send(new RentalRequestNotification($car, $customer,$owner));


        return redirect()->route('costumers')->with('success', 'Car rental has been successfully requested!');
    }

}


