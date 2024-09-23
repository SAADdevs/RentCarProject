<?php

namespace App\Http\Controllers\ownerCar;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Notification;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\PutingCarForRentingNotification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CreateCarController extends Controller
{
    public function index()
    {
        return view("owner.createCar");
    }

    public function create(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'city' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'image_url' => 'required|image|mimes:jpeg,png,jpg',
            'description' => 'nullable|string',
        ]);
        $newName = time() . '-' . $request->model . '.' .$request->image_url->extension();

        $test = $request->image_url->move(public_path('images'),$newName);
        $car = new Car();
        $car->user_id = Auth::user()->id;
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->city = $request->input('city');
        $car->price_per_day = $request->input('price_per_day');
        $car->image_url = $newName;
        $car->description = $request->input('description');
        $car->save();
        $owner = Auth::user();
        //notif for owner
        Notification::create([
            'user_id' => auth("")->id(),
            'message' => 'Car  with id ' . $car->id . ' created.',
            'is_read' => false,
        ]);
        //notif for admin
        $adminId = User::where('role', 'admin')->first()->id;
        Notification::create([
            'user_id' => $adminId,
            'message' => 'rental request  created by ' . $owner->name . ' model.  ' .$car->model .'with id' .$car->id,
            'is_read' => false,
        ]);
        Mail::to('saadchabili20@gmail.com')->send(new PutingCarForRentingNotification($car,$owner));

            return redirect()->route('owners')->with('success', 'Car registered successfully!');
        }

    }

