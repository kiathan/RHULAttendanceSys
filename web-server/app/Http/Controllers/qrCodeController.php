<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class qrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guard $auth, $id = null)
    {
        $user = \App\User::find($auth->user()->id)->load('course.lecture');

        $currentTime = new \Carbon\Carbon();
        $dayofweek = strtolower($currentTime->format('l'));
        $time = $currentTime->toTimeString();
        $qrcode = null;
        foreach ($user->course as $course) {
            foreach ($course->lecture()->where('dayofweek', $dayofweek)->where('starttime', '<=', $time)->where('endtime', '>=', $time)->get() as $lecture) {
                $qrcode = $lecture->getActiveLecture()->first();
            }
        }


        return view('qr')->with(['qrcode' => $qrcode]);
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
