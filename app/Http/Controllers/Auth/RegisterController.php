<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\loginNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewloginNotification;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
class RegisterController extends Controller
{
        public function create()
        {
                return view('Auth.register');
        }

        public function store(Request $request)
        {//dd($request->all());
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'city' => 'required|string|max:255',
                'phone_number' => 'required|string|digits:10',
                'role' => 'required|string',
            ]);


            $name=$request->input('name');
            $email=$request->input('email');
            $password=$request->input('password');
            $role=$request->input('role');
            $city=$request->input('city');
            $phone=$request->input('phone_number');

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role,
                'city'=>$city,
                'phone_number'=>$phone,
            ]);

        $toEmail = 'saadchabili20@gmail.com';
        $message = $name . ' from ' .$city .'  do registration In in your website as ' .$role .' check it out .';
        $subject = 'new user join';
        Mail::to($toEmail)->send(new NewloginNotification($message,$subject));

        //admin notif
        Notification::create([
            'user_id' => 15,
            'message' => $name . ' from ' .$city .'  do registration In in your website as ' .$role ,
            'is_read' => false,
        ]);
        return redirect('/');
        }
}
