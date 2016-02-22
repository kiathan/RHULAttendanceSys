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
    	$route = $request->input('route');
        return view($route);
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $route = $request->input('route');

        $signInResult = Auth::attempt([
                              "username" => $username,
                              "password" => $password]);

        return view($route)->with(["signInResult" => $signInResult]);
    }
}
