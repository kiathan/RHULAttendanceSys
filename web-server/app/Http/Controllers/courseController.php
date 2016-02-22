<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couses = \App\course::all();
        return view('couse.index')->with(["couses" => $couses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Need venues and couses
        $couses = \App\course::all();
        $venues = \App\venue::all();
        return view('couse.create')->with(['couses' => $couses, 'venues' => $venues]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \App\course::create($request->all());
        return redirect("/");

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addUserToCouse(Request $request)
    {
        $userid = $request->input('user_id');
        $couseid = $request->input('couse_id');
        $role = $request->input('role');

        $user = \App\User::find($userid);
        $couse = \App\course::find($couseid);

        if ($user->saveCouse($couse, $role)) {
            return redirect("/");
        } else {
            return redirect("/auth/create");
        }
    }
}
