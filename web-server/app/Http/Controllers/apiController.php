<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;

class apiController extends Controller
{
    public function getLogin(Request $request)
    {
        $authJSON['message'] = "use POST to login";
        return response()->json($authJSON);
    }

    public function postLogin(Request $request)
    {
        $authJSON          = array();
        $authJSON['state'] = "failure";

        //Sing in

        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt([
                              "username" => $username,
                              "password" => $password])
        ) {
            $authJSON['state'] = "success";
            $authJSON['token'] = Auth::user()->username;
        }

        return response()->json($authJSON);
    }

}
