<?php

namespace App\Http\Controllers;

use Response;
use App\lecture_instend;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class lectureInstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecture_instends = \App\lecture_instend::all();
        return view('lecture_instend/index')->with(['lecture_instends' => $lecture_instends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($filter = false)
    {
        if (!$filter) {
            $lectures = \App\lecture::all();
        } else {
            $currentTime = new Carbon();
            $day = strtolower($currentTime->format("l"));
            $time = $currentTime->format("G:i:s");
            $lectures = \App\lecture::where("dayofweek", $day)->where("starttime", "<=", $time)->where("endtime", ">=", $time)->get();
        }

        return view('lecture_instend/create')->with(['lectures' => $lectures]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\App\lecture_instend::where('isActive', 'true')->where('lecture_id', $request->get('lecture_id'))->first()) {
            return redirect("/");
        }
        \App\lecture_instend::create($request->all());
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
        return \App\lecture_instend::find($id);
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
        $instance = \App\lecture_instend::where('isActive', 'true')->first($id);

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

    public function auth(Request $request)
    {

    }

    public function qrCode(Request $request, $id)
    {

        $lecture_instend = \App\lecture_instend::find($id);

        if (is_null($lecture_instend)) {
            /*
             * TODO update to proper error handling
             */
            return "";
        }

        $response = Response::make($lecture_instend->sendQRcode(), 200);


        return $response;

    }
}
