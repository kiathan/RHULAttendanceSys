<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use KDuma\Permissions\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::all();

        if ($request->segment(1) == "api") {
            return $users;
        }

        return view('auth.index')->with(["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $roles = Role::all();

        $courses = \App\course::all();
        return view('auth.create', ["roles" => $roles, "courses" => $courses]);
    }
    
    public function users(Request $request)
    {
        $roles = Role::all();

        $courses = \App\course::all();
        
         $users = \App\User::all();
        
        return view('users', ["roles" => $roles, "courses" => $courses, "users" => $users]);
    }

    public function showLogin(Request $request)
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->segment(1) == "api") {
            $username = $request->input('username');
            $password = $request->input('password');

            $reuslts = Auth::attempt([
                "username" => $username,
                "password" => $password]);

            if (Auth::check()) {
                $user = Auth::user();
                $user->token = Str::random(60) . "-" . time();
                $user->save();

                return response()->json(["state" => "success", "username" => $user->username, "user_id" => $user->id, "token" => hash("sha256", $user->token)]);
            } else {
                return json_encode(["state" => "failure", "message" => "username or password wrong"]);

            }
        }

        $username = $request->input('username');
        $password = hash("sha256", $request->input('password'));
		$remember = $request->input('remember');

        $reuslts = Auth::attempt([
            "username" => $username,
            "password" => $password],
            $remember);


        return view('/welcome')->with(["signInResult" => Auth::check()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new \App\User();
        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = Hash::make(hash("sha256", $request->input('password')));


        if ($user->save()) {
			if(isSet($request->courses)) {
	    	    foreach ($request->get('courses') as $course_id) {
    		        $user->saveCouse(\App\course::find($course_id), 'student');
        		}	
        	}
			
			return redirect("/users");
            
        } else {
            return redirect("/users");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        $id = $request->input('id');
        $user = \App\User::find($id);
 
        return response()->json([
        	'username' => $user->username,
        	'firstname' => $user->firstname,
        	'middlename' => $user->middlename,
        	'lastname' => $user->lastname,
        	'email' => $user->email,
        	'role' => $user->role,
        	'course' => $user->course
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    	
    	$user = \App\User::find((int)$request->input('id'));
    	
    	$username = $request->input('username');
    
        if(!empty($username) && !empty($user)) {
        
        	$user->username = $username;
        
        }
        
        $password = $request->input('password');
        
        if(!empty($password) && !empty($user)) {
        
        	$user->password = Hash::make(hash("sha256", $request->input('password')));
        
        }
        
        $firstname = $request->input('firstname');
        
        if(!empty($firstname) && !empty($user)) {
        
        	$user->update(['firstname' => $firstname]);
        
        }
        
        $middlename = $request->input('middlename');
        
        if(!empty($middlename) && !empty($user)) {
        
        	$user->middlename = $middlename;
        
        }
        
        $lastname = $request->input('lastname');
        
        if(!empty($lastname) && !empty($user)) {
        
        	$user->lastname = $lastname;;
        
        }
        
        $email = $request->input('email');
        
        if(!empty($email) && !empty($user)) {
        
        	$user->email = $email;
        
        }
        if($user != null) {
        if ($user->save()) {
			if(isSet($request->courses)) {
	    	    foreach ($request->get('courses') as $course_id) {
    		        $user->saveCouse(\App\course::find($course_id), 'student');
        		}	
        	}
			
			return redirect("/users");
            
        }
        }
        
        return redirect("/");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    	$id = $request->input('id');
        $user = \App\User::find($id);
        $user->delete();
        return redirect('/users');
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
        
    }
}


