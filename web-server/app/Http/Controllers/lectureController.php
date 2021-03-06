<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;


class lectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, Guard $auth, $filter = "all")
    {
        if ($request->segment(1) == "api") {
            $user = $auth->user();
            $user = \App\User::find($user->id);
            // TODO switch this to the state pattern
            if ($filter == "current") {
                $lecutes = $user->currentLectures();
            } else {
                $lecutes = $user->allLectures();
            }
            return $lecutes;
        }
        $lectures = \App\lecture::all();

        return view('lecture.index')->with(['lectures' => $lectures]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venues = \App\venue::all();
        $couses = \App\course::all();
        return view('lecture.create')->with(['couses' => $couses, "venues" => $venues]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \App\lecture::create($request->all());
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

    public function createInstance($lecture_id)
    {

    }

    public function updateInstance()
    {

    }

    public function timetable(Guard $guard)
    {
        $user = $guard->user();
        $user = \App\User::find($user->id);

        if (!is_null($user)) {
            $lecutes = $user->allLectures();
        } else {
            $lecutes = NULL;
        }
        return view('timetable')->with(["lectues" => $lecutes]);
    }
}
