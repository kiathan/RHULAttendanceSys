<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

class attendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Guard $auth)
    {
        $user = \App\User::find($auth->user()->id)->load('course.lecture.lecture_instance');

        $attendRate = array();
        $overall = array('count' => 0, 'attended' => 0);
        foreach ($user->course as $course) {
            $attendRate[$course->code]['attended'] = 0;
            $attendRate[$course->code]['count'] = 0;
            foreach ($course->lecture as $lecture) {
                foreach ($lecture->lecture_instance as $li) {
                    if ($user->checkIfAlreadyAttendnes($li)) {
                        $attendRate[$course->code]['attended'] += 1;
                        $overall['attended'] += 1;
                    }
                    $attendRate[$course->code]['count'] += 1;
                    $overall['count'] += 1;
                }
            }
        }

        // Build the query her
        return view('overall')->with(['attendRate' => $attendRate, 'overall' => $overall]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show attends for class / user

        // Give list
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
}
