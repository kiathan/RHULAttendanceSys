<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QuestionAndAwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Guard $auth)
    {
        $user = \App\User::find($auth->user()->id)->load('course.lecture');

        $currentTime = new \Carbon\Carbon();
        $dayofweek = strtolower($currentTime->format('l'));
        $time = $currentTime->toTimeString();
        $qrcode = null;
        $courseOfLecture = null;
        foreach ($user->course as $course) {
            foreach ($course->lecture()->where('dayofweek', $dayofweek)->where('starttime', '<=', $time)->where('endtime', '>=', $time)->get() as $lecture) {
                $lecture_instend = $lecture->getActiveLecture()->first();
                if (!is_null($lecture_instend)) {
                    $courseOfLecture = $course;
                    break;
                }
            }
        }

        if (!isset($lecture_instend) || is_null($lecture_instend)) {
            return view('qa-feedback')->with(['lecture_instend' => NULL]);
        }

        $questions = $lecture_instend->question;
        return view('qa-feedback')->with(['questions' => $questions, 'qaOrder' => ['A', 'B', 'C', 'D']]);
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
    public function show(Guard $auth)
    {
        $user = \App\User::find($auth->user()->id)->load('course.lecture');

        $currentTime = new \Carbon\Carbon();
        $dayofweek = strtolower($currentTime->format('l'));
        $time = $currentTime->toTimeString();
        $qrcode = null;
        $courseOfLecture = null;
        foreach ($user->course as $course) {
            foreach ($course->lecture()->where('dayofweek', $dayofweek)->where('starttime', '<=', $time)->where('endtime', '>=', $time)->get() as $lecture) {
                $lecture_instend = $lecture->getActiveLecture()->first();
                if (!is_null($lecture_instend)) {
                    $courseOfLecture = $course;
                    break;
                }
            }
        }

        if (!isset($lecture_instend) || is_null($lecture_instend)) {
            return view('qa-feedback')->with(['lecture_instend' => NULL]);
        }

        $questions = $lecture_instend->question()->orderBy('created_at', 'desc')->limit(1)->get();
        return view('qa-feedback')->with(['questions' => $questions, 'qaOrder' => ['A', 'B', 'C', 'D']]);
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
