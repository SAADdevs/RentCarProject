<?php

namespace App\Http\Controllers\ownerCar;
use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Car;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\Activity;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function ownerIndex()
    {
        //owner staticts
        $unapprovedCars = Car::where('status','pending')->count();
        $pendingCars = Rental::where('status', 'pending')->count();
        $totalCars = Car::count();
        $activeRentals = Rental::where('status', 'approved')->count();

        $cars = Car::all()->map(function ($car) {
            $car->last_updated = Carbon::parse($car->updated_at)->diffForHumans();
            return $car;
        });

        //all notifications
        $notifications = Notification::where('user_id', Auth('')->id())
        ->Where('is_read', false)
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();

Notification::where('user_id', Auth('')->id())
->where('is_read', false)
->update(['is_read' => true]);

    //owner acitvities
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;
    $rentalsThisMonth = Rental::whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->where('status', 'completed')
                            ->count();

    $lastMonth = Carbon::now()->subMonth()->month;
    $lastMonthYear = Carbon::now()->subMonth()->year;
    $rentalsLastMonth = Rental::whereYear('created_at', $lastMonthYear)
                              ->whereMonth('created_at', $lastMonth)
                              ->where('status', 'completed')
                              ->count();


        return view("owner.owner",['totalCars'=>$totalCars
        ,'activeRentals'=>$activeRentals,
        'pendingCars'=>$pendingCars,
        'cars'=>$cars,
        'notifications'=>$notifications,
        'unpporvedCars'=>$unapprovedCars,
        'TotalRentalsOfThisMonth'=>$rentalsThisMonth,
        'TotalRentalsOfLastMonth'=>$rentalsLastMonth,
    ]);
    }
}
