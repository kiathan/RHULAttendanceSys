<?php

namespace App\Http\Controllers;

use App\lecture_instend;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
use Illuminate\Contracts\Auth\Guard;

class quizController extends Controller
{

    public function ansQuiz(Request $data, Guard $auth)
    {
        $student_buf = \App\User::find($auth->user()->id);

        // Get the timestamp
        $currentDateTime = new \Carbon\Carbon();
        // Get the day of week monday, tuesday etc
        $dayOfWeek = strtolower($currentDateTime->format('l'));

        // Ge the current course
        $couse = \App\course::where('code', $data->input('courseID'))->first();

        if (is_null($couse)) {
            return json_encode(["state" => "failure", "message" => "No course with that course code"]);
        }

        // Get the current lecture also
        $lecture = $couse->lecture()
            ->where('dayofweek', $dayOfWeek)
            ->where('starttime', '<=', $currentDateTime->format('H:i:s'))
            ->where('endtime', '>=', $currentDateTime->format('H:i:s'))
            ->first();

        if (is_null($lecture)) {
            return json_encode(["state" => 'failure', "message" => "No lecture currenly"]);
        }

        // Check to see if there is an lecture in progress
        if (!$lecture->hasActiveLecture()) {
            return json_encode(["state" => "failure", "message" => "No active lecture instances"]);
        }
        //Get the list of current lecutes this is an array,
        $lecture_instance = $lecture->getActiveLecture()->first();

        // Get the list of question active in the lecture
        $question = $lecture_instance->question()->where('isValit', true)->first();


        if (is_null($question)) {
            return json_encode(["state" => "failure", "message" => "No question"]);
        }

        $answer = $question->awnser()->where('user_id', $student_buf->id)->first();
        if (is_null($answer)) {
            $answer = new \App\awnser();
            $answer->question_id = $question->id;
            $answer->user_id = $student_buf->id;
            $answer->isValit = true;
        }
        $answer->awnser = $data->get('awnser');
        $answer->save();

        return json_encode(["state" => "success", "message" => "answers recode"]);
    }


    public function startNstop(Request $request, Guard $auth)
    {

        $student_buf = \App\User::find($auth->user()->id);

        // Get the timestamp
        $currentDateTime = new \Carbon\Carbon();
        // Get the day of week monday, tuesday etc
        $dayOfWeek = strtolower($currentDateTime->format('l'));

        // Ge the current course
        $couse = \App\course::where('code', $request->input('courseID'))->first();

        if (is_null($couse)) {
            return json_encode(["state" => "failure", "message" => "No course with that course code"]);
        }

        // Get the current lecture also
        $lecture = $couse->lecture()
            ->where('dayofweek', $dayOfWeek)
            ->where('starttime', '<=', $currentDateTime->format('H:i:s'))
            ->where('endtime', '>=', $currentDateTime->format('H:i:s'))
            ->first();

        if (is_null($lecture)) {
            return json_encode(["state" => 'failure', "message" => "No lecture currenly"]);
        }

        // Check to see if there is an lecture in progress
        if (!$lecture->hasActiveLecture()) {
            return json_encode(["state" => "failure", "message" => "No active lecture instances"]);
        }
        //Get the list of current lecutes this is an array,
        $lecture_instance = $lecture->getActiveLecture()->first();

        // Get the list of question active in the lecture
        $question = $lecture_instance->question()->where('isValit', true)->first();

        if (is_null($question) && $request->get('state') == 'true') {
            $question = new \App\question();
            $question->lecture_instend_id = $lecture_instance->id;
            $question->isValit = true;
            $question->save();

            return json_encode(["state" => "success", "message" => "A new question has been created"]);
        } else if (!is_null($question) && $request->get('state') == 'false') {
            $question->isValit = false;
            $question->save();
            $data = json_encode($question->hasMany(\App\awnser::class)->groupBy('awnser')->get(['awnser', DB::raw('count(*)')]));
            return json_encode(["state" => "success", "message" => "The current question has stopped.", "data" => $data]);
        } else {

            return json_encode(["state" => "failure", "message" => "No questions available to stop"]);
        }
    }


    public function show(Request $request, Guard $auth)
    {
        $student_buf = \App\User::find($auth->user()->id);

        // Get the timestamp
        $currentDateTime = new \Carbon\Carbon();
        // Get the day of week monday, tuesday etc
        $dayOfWeek = strtolower($currentDateTime->format('l'));

        // Ge the current course
        $couse = \App\course::where('code', $request->input('courseID'))->first();

        if (is_null($couse)) {
            return json_encode(["state" => "failure", "message" => "No course with that course code"]);
        }

        // Get the current lecture also
        $lecture = $couse->lecture()
            ->where('dayofweek', $dayOfWeek)
            ->where('starttime', '<=', $currentDateTime->format('H:i:s'))
            ->where('endtime', '>=', $currentDateTime->format('H:i:s'))
            ->first();

        if (is_null($lecture)) {
            return json_encode(["state" => 'failure', "message" => "No lecture currenly"]);
        }

        // Check to see if there is an lecture in progress
        if (!$lecture->hasActiveLecture()) {
            return json_encode(["state" => "failure", "message" => "No active lecture instances"]);
        }
        //Get the list of current lecutes this is an array,
        $lecture_instance = $lecture->getActiveLecture()->first();

        // Get the list of question active in the lecture

        $question = $lecture_instance->question()->where('isValit', true)->orderBy('created_at', 'decs')->first();


        if (is_null($question)) {
            return json_encode(["state" => "failure", "message" => "No question"]);
        }


        $question->hasMany(\App\awnser::class)->groupBy('awnser')->get(['awnser', DB::raw('count(*)')]);

        if ($request->segment(1) == "api") {
            return "";
        }

        return "";
    }

}
