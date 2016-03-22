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
        //$user = \App\User::find($auth->user()->id)->load('course.lecture.lecture_instance');
        $courseList = array();
        foreach (\App\User::all()->load('course.lecture.lecture_instance') as $user) {
            $attendRate = array();
            $overall = array('count' => 0, 'attended' => 0);
            foreach ($user->course as $course) {
                if (!array_has($courseList, $course->code)) {
                    $courseList[] = $course->code;
                }
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
            $usersAttendsRate[] = ['username' => $user->username, 'attends' => $attendRate, 'overall' => $overall];
        }
        return view('overall')->with(['usersAttendsRate' => $usersAttendsRate, 'courseList' => $courseList]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guard $auth, $id = null)
    {
        if (is_null($id)) {
            $user = \App\User::find($auth->user()->id)->load('course.lecture.lecture_instance');
        } else {
            $user = \App\User::find($id);
        }
        $courseList = array();
        $attendRate = array();
        $overall = array('count' => 0, 'attended' => 0);
        foreach ($user->course as $course) {
            if (!array_has($courseList, $course->code)) {
                $courseList[] = $course->code;
            }
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
        $usersAttendsRate[] = ['username' => $user->username, 'attends' => $attendRate, 'overall' => $overall];

        return view('overall')->with(['usersAttendsRate' => $usersAttendsRate, 'courseList' => $courseList]);
    }

    public function showLecture(Guard $auth, $id = null)
    {

        if (is_null($id)) {
            $user = \App\User::find($auth->user()->id)->load('course.lecture');

            $currentTime = new \Carbon\Carbon();
            $dayofweek = strtolower($currentTime->format('l'));
            $time = $currentTime->toTimeString();
            $qrcode = null;
            foreach ($user->course as $course) {
                foreach ($course->lecture()->where('dayofweek', $dayofweek)->where('starttime', '<=', $time)->where('endtime', '>=', $time)->get() as $lecture) {
                    $lecture_instend = $lecture->getActiveLecture()->first();
                }
            }

        } else {
            $lecture_instend = \App\lecture_instend::find($id);
        }


        if (is_null($lecture_instend)) {
            return view('overall-lecture')->with(['UserSignIn' => NULL, 'UserNotSignIn' => NULL]);
        }

        $UserSignIn = $lecture_instend->attendentsSignin;
        $UserNotSignIn = $lecture_instend->lecture->course->user()->whereNotIn('id', $lecture_instend->attendentsSignin->fetch('id')->toArray())->get();

        return view('overall-lecture')->with(['UserSignIn' => $UserSignIn, 'UserNotSignIn' => $UserNotSignIn]);
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
