<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    //public function profile(Request $request)
    {
        //$request->session()->flush();
        return view('profile');
    }

    public function index()
    {
        return view('user');
    }
}
