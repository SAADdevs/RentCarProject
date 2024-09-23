<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\loginNotification;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewloginNotification;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    public function create()
    {
        return view("Auth.login");
    }

    public function store(Request $request)
{

    $attributes = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ]);


    if (Auth::attempt($attributes)) {
        
        $request->session()->regenerate();
        if (Auth::user()->role === 'owner') {
            return redirect()->route('owners');
        } elseif (Auth::user()->role === 'admin') {
            return redirect()->route('admin');
        } else {
            return redirect()->route('costumers');
        }
    }

    throw ValidationException::withMessages([
        'email' => 'These credentials do not match our records.',
    ]);
}

}

