<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class singinColtroller extends Controller
{
    public function singin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $signInResult = Auth::attempt([
                              "username" => $username,
                              "password" => $password]);

        return view('login')->with(["signInResult" => $signInResult]);
    }
}