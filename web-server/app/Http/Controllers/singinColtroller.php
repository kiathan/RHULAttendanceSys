<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class singinColtroller extends Controller
{
    public function singin()
    {
        return view('login');
    }

    public function login()
    {
        $signInResult = false;
        return view('login')->with(["signInResult" => $signInResult]);
    }
}
