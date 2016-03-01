<?php

namespace App\Http\Controllers;

use Response;
use App\lecture_instend;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;


class lectureInstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Guard $auth)
    {
        if ($request->segment(1) == "api") {
            $user = $auth->user();
            $user = \App\User::find($user->id);
            $lecutesInstance = $user->getCurrentLectureInstance();
            $checkOfActiveCount = sizeof($lecutesInstance);
            if ($checkOfActiveCount == 0) {
                $response['state'] = 'failure';
                $response['message'] = 'No lecture is active right now';

                return json_encode($response);
            }
            $reuslt = $user->getCurrentLectureInstance();
            $reuslt = array_merge($reuslt, ['state' => "success", 'message' => ""]);
            return json_encode($reuslt);
        }
        $lecture_instends = \App\lecture_instend::where('isActive', '1')->get()->load('lecture');
        return view('lecture_instend/index')->with(['lecture_instends' => $lecture_instends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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


        } else {
            $currentTime = new Carbon();
            $day = strtolower($currentTime->format("l"));
            $time = $currentTime->format("G:i:s");
            $lectures = \App\lecture::where("dayofweek", $day)->where("starttime", "<=", $time)->where("endtime", ">=", $time)->get();
        }

        return view('lecture_instend/create')->with(['lectures' => $lectures, "users" => $user]);
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
        $lecture_instend = \App\lecture_instend::find($id);
        return view('lecture_instend.show')->with(["lecture_instend" => $lecture_instend]);
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
        $instance = \App\lecture_instend::find($id);
        $instance->fill($request->all());
        $instance->save();
        return redirect("/lecture_instends/show/" . $id);
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

    /**
     * @param Request $request
     * @param Guard $auth
     *
     * This is for sign in an user
     * API
     *  student    =>     student number (to be sign in)
     *  date       =>     dd-mm-yyyy
     *  time       =>     hh:mm
     *  classcode  =>     yyxxxx
     *
     */
    public function authUser(Request $request, Guard $auth)
    {

        $currentUser = $auth->user();
        $userToSignIn = \App\User::where('username', $request->input('username'))->first();
        $time = $request->input('time');

        $dateTime = new \Carbon\Carbon($request->input('date') . " " . $time);
        $course = \App\course::where('code', $request->input('classcode'))->first();

        if (is_null($course)) {
            return json_encode(["state" => "failure", "message" => "No course with that code"]);
        }

        $lecture = $course->lecture()// Get the lectures related to the course
        ->where('dayofweek', strtolower($dateTime->format('l')))// Get the day of week
        ->where('starttime', '<=', $dateTime->format('h:i:s'))// Check that the start time is before or equal to the time given
        ->where('endtime', '>=', $dateTime->format('h:i:s'))// Check that the end time is after or equal to the time qiven
        ->first();                                          // Get the first instances as the can be to lecture

        if (is_null($lecture)) {
            return json_encode(["state" => "failure", "message" => "No lecture on selected date and/or time"]);
        }

        $lecture_instance = $lecture->lecture_instance()->orderBy('created_at', 'decs')->first();

        if (is_null($lecture_instance)) {
            return json_encode(["state" => "failure", "message" => "can't find selected lecture"]);
        }

        if (!$userToSignIn->checkIfAlreadyAttendnes($lecture_instance)) {
            $userToSignIn->addAttendnes($lecture_instance);
            return json_encode(["state" => "success", "message" => "you have successfully signed the student into the lecture"]);
        } else {
            return json_encode(["state" => "failure", "message" => "unable to sign user in"]);
        }
    }

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
            $instanceAuth = NULL;
            foreach ($lecture_instances as $lecture_instance) {
                if ($lecture_instance->checkQRcode($request->get('lectureAuthCode'))) {
                    $instanceAuth = $lecture_instance;
                    break;
                }
            }

            if (!is_null($instanceAuth) && $user->checkIfAlreadyAttendnes($instanceAuth)) {
                $jsonRespones['state'] = "success";
                $jsonRespones['message'] = "Already sign in";
                return json_encode($jsonRespones);
            } else if ($instanceAuth) {
                $jsonRespones['state'] = "success";
                $jsonRespones['message'] = "you have sign in to the lecture";
                $user->addAttendnes($instanceAuth);
                return json_encode($jsonRespones);
            } else {
                $jsonRespones['state'] = "failure";
                $jsonRespones['message'] = "The qr code did not match the entry for the class";
                return json_encode($jsonRespones);
            }
        }
        return "In progress please hold on";
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


    /*DEBUG INFO*/
    public function createLectureInstance(Request $request)
    {
        $user = \App\User::find($request->get('user_id'));
        if (sizeof($user->currentLectures()) == 0) {
            \App\lecture::createRandomLecture($user);
        }

        $lecutres = $user->currentLectures();
        foreach ($lecutres as $lecutre) {
            if (\App\lecture_instend::where('isActive', 'true')->where('lecture_id', $lecutre->id)->first()) {
                return redirect("/");
            }
        }

        foreach ($lecutres as $lecutre) {
            \App\lecture_instend::create(['lecture_id' => $lecutre->id, 'isActive' => '1']);
            break;
        }
        return redirect("/");
    }

    public function status(Request $request)
    {

    }

    public function attends(Request $request)
    {

    }
}
