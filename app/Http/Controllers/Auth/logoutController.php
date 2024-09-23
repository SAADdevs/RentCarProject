<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class logoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
