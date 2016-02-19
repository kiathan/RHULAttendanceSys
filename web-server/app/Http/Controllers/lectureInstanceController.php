<?php

namespace App\Http\Controllers;

use Response;
use App\lecture_instend;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use Illuminate\Contracts\Auth\Guard;
>>>>>>> Mobile-UI-(draft)

class lectureInstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        $lecture_instends = \App\lecture_instend::all();
=======
        $lecture_instends = \App\lecture_instend::where('isActive', '1')->get();
>>>>>>> Mobile-UI-(draft)
        return view('lecture_instend/index')->with(['lecture_instends' => $lecture_instends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function create($filter = false)
    {
        if (!$filter) {
            $lectures = \App\lecture::all();
=======
    public function create($filter = false, $user_id = false)
    {
        $user = \App\User::all();
        $userFilder = \App\User::find($user_id);
        if (!$filter && !$user_id) {
            $lectures = \App\lecture::all();
        } else if (!is_null($userFilder)) {
            $lectures = $userFilder->allLectures();
            $currentTime = new Carbon();
            $day = strtolower($currentTime->format("l"));
            $time = $currentTime->format("G:i:s");
            $lectures = \App\lecture::whereIn('id', $lectures->pluck('id'))->where("dayofweek", $day)->where("starttime", "<=", $time)->where("endtime", ">=", $time)->get();


>>>>>>> Mobile-UI-(draft)
        } else {
            $currentTime = new Carbon();
            $day = strtolower($currentTime->format("l"));
            $time = $currentTime->format("G:i:s");
            $lectures = \App\lecture::where("dayofweek", $day)->where("starttime", "<=", $time)->where("endtime", ">=", $time)->get();
        }

<<<<<<< HEAD
        return view('lecture_instend/create')->with(['lectures' => $lectures]);
=======
        return view('lecture_instend/create')->with(['lectures' => $lectures, "users" => $user]);
>>>>>>> Mobile-UI-(draft)
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
<<<<<<< HEAD
        return \App\lecture_instend::find($id);
=======
        $lecture_instend = \App\lecture_instend::find($id);
        return view('lecture_instend.show')->with(["lecture_instend" => $lecture_instend]);
>>>>>>> Mobile-UI-(draft)
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
<<<<<<< HEAD
        $instance = \App\lecture_instend::where('isActive', 'true')->first($id);

=======
        $instance = \App\lecture_instend::find($id);
        $instance->fill($request->all());
        $instance->save();
        return redirect("/lecture_instends/show/" . $id);
>>>>>>> Mobile-UI-(draft)
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

<<<<<<< HEAD
    public function auth(Request $request)
    {

=======
    public function auth(Request $request, Guard $auth)
    {
        if ($request->segment(1) == "api") {
            $request->all();
            $user = \App\User::find($auth->user()->id);
            $lecture_instances = $user->getCurrentLectureInstance();

            if (is_null($lecture_instances) || empty($lecture_instances)) {
                $jsonRespones['state'] = "failure";
                $jsonRespones['message'] = "No lecture instance is active for the user";
                return json_encode($jsonRespones);
            }
            $lecture_instances = $lecture_instances[0];
            $authStatus = $lecture_instances->checkQRcode($request->get('lectureAuthCode'));

            if ($user->checkIfAlreadyAttendnes($lecture_instances)) {
                $jsonRespones['state'] = "success";
                $jsonRespones['message'] = "Already sign in";
                return json_encode($jsonRespones);
            } else if ($authStatus) {
                $jsonRespones['state'] = "success";
                $jsonRespones['message'] = "you have sign in to the lecture";
                $user->addAttendnes($lecture_instances);
                return json_encode($jsonRespones);
            } else {
                $jsonRespones['state'] = "failure";
                $jsonRespones['message'] = "The qr code did not matach the entry for the class";
                return json_encode($jsonRespones);
            }
        }
        return "In progress please hold on";
>>>>>>> Mobile-UI-(draft)
    }

    public function qrCode(Request $request, $id)
    {
<<<<<<< HEAD

=======
>>>>>>> Mobile-UI-(draft)
        $lecture_instend = \App\lecture_instend::find($id);

        if (is_null($lecture_instend)) {
            /*
             * TODO update to proper error handling
             */
            return "";
        }
<<<<<<< HEAD

        $response = Response::make($lecture_instend->sendQRcode(), 200);


        return $response;
=======
        $response = Response::make($lecture_instend->sendQRcode(), 200);
        return $response;
    }


    /*DEBUG INFO*/
    public function createLectureInstance(Request $request)
    {
        $user = \App\User::find($request->get('user_id'));
        if (!$user->currentLectures()) {
            \App\lecture::createRandomLecture($user);
        }

        $lecutre = $user->currentLectures();
        if (\App\lecture_instend::where('isActive', 'true')->where('lecture_id', $lecutre->id)->first()) {
            return redirect("/");
        }
        \App\lecture_instend::create(['lecture_id' => $lecutre->id, 'isActive' => '1']);
        return redirect("/");
    }

    public function status(Request $request){
>>>>>>> Mobile-UI-(draft)

    }
}
