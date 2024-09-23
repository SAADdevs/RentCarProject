<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Notification;
use App\Models\User;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Index()
    {
        $totalUsers = User::count();
        $totalCars = Car::count();
        $activeRentals = Rental::where('status', 'ongoing')->count();
        $pendingRequests = Rental::where('status', 'pending')->count();

        $availableCars = Car::where('availabilty_status', '1')->count();
        $rentedCars = Car::where('availabilty_status', '0')->count();


    $rentalTrends = [
        'Jan' => Rental::whereMonth('created_at', 1)->count(),
        'Feb' => Rental::whereMonth('created_at', 2)->count(),
        'Mar' => Rental::whereMonth('created_at', 3)->count(),
        'Apr' => Rental::whereMonth('created_at', 4)->count(),
        'May' => Rental::whereMonth('created_at', 5)->count(),
        'Jun' => Rental::whereMonth('created_at', 6)->count(),
    ];


    $rentals = Rental::all();
    $monthlyRentals = array_fill(0, 12, 0);
    foreach ($rentals as $rental) {
        $month = Carbon::parse($rental->created_at)->month;
        $monthlyRentals[$month - 1]++;
    }



        $recentActivities = Notification::where('user_id', auth("")->id())
        ->orderBy('created_at', 'asc')
        ->take(10)
        ->get();

        return view("admin.admin",[
            'totalUsers'=>$totalUsers,
            'totalCars'=>$totalCars,
            'activeRentals'=>$activeRentals,
            'pendingRequest'=>$pendingRequests,
            'availableCars'=>$availableCars,
            'rentalTrends'=>$rentalTrends,
            'rentedCars'=>$rentedCars,
            'rentalsJanuary' => $monthlyRentals[0],
            'rentalsFebruary' => $monthlyRentals[1],
            'rentalsMarch' => $monthlyRentals[2],
            'rentalsApril' => $monthlyRentals[3],
            'rentalsMay' => $monthlyRentals[4],
            'rentalsJune' => $monthlyRentals[5],
            'rentalsJuly' => $monthlyRentals[6],
            'rentalsAugust' => $monthlyRentals[7],
            'rentalsSeptember' => $monthlyRentals[8],
            'rentalsOctober' => $monthlyRentals[9],
            'rentalsNovember' => $monthlyRentals[10],
            'rentalsDecember' => $monthlyRentals[11],
            'recentActivities'=>$recentActivities,
        ]);
    }
}
