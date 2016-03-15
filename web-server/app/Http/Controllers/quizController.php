<?php

namespace App\Http\Controllers;

use App\lecture_instend;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;
use Illuminate\Contracts\Auth\Guard;

class quizController extends Controller
{

    public function ansQuiz(Request $data, Guard $auth)
    {
        if ($data->segment(1) == "api") {

            // Get current user
            $student_buf = \App\User::find($auth->user()->id);

            // Get the timestamp
            $currentDateTime = new \Carbon\Carbon();
            // Get the day of week monday, tuesday etc
            $dayOfWeek = strtolower($currentDateTime->format('l'));

            // Ge the current course
            $course = \App\course::where('code', $data->input('courseID'))->first();
            // Get the current lecture also
            $lecture = $course->lecture()
                ->where('dayofweek', $dayOfWeek)
                ->where('starttime', '>=', $currentDateTime->format('h:i:s'))
                ->where('endtime', '<=', $currentDateTime->format('h:i:s'))
                ->first();

            // Check to see if there is an lecture in progress
            if (!$lecture->ActiveLecture) {
                return json_encode(["state" => "Change to fail", "Message" => "No active lecture instances"]);
            }
            //Get the list of current lecutes this is an array,
            $lecture_instances = $lecture->getActiveLecture;
            foreach ($lecture_instances as $lecture_instance) {
                // Get the list of question active in the lecture
                $question = $lecture_instance->question;
            }

            if (is_null($student_buf)) {
                $jsonResponse['state'] = "failure";
                $jsonResponse['message'] = "Invalid student.";
                return json_encode($jsonResponse);
            } else if (is_null($lecture_instances) || empty($lecture_instances)) {
                $jsonResponse['state'] = "failure";
                $jsonResponse['message'] = "There's no active lecture now!";
                return json_encode($jsonResponse);
            } else if (empty($data->input('courseID'))) {

                $jsonResponse['state'] = "failure";
                $jsonResponse['message'] = "You have to register to a lecture first!";
                return json_encode($jsonResponse);
            } else {
                $question = $lecture_instances->question->first();
                if (is_null($question)) {
                    $jsonResponse['state'] = "failure";
                    $jsonResponse['message'] = "There's no questions asked at the moment!";
                    return json_encode($jsonResponse);
                } else {
                    $user = $data->input('username');
                    $answer = $data->input('answer');
                    DB::table('awnsers')->insert(
                        ['question_id' => $question->id, 'username' => $user, 'awnser' => $answer]
                    );
                    $jsonResponse['state'] = "success";
                    $jsonResponse['message'] = "You have answered the question successfully! Thanks!";
                    return json_encode($jsonResponse);
                }

            }
        }
    }


    public function startNstop(Request $switcher)
    {
        // Get current user
        $student_buf = \App\User::find($auth->user()->id);

        // Get the timestamp
        $currentDateTime = new \Carbon\Carbon();
        // Get the day of week monday, tuesday etc
        $dayOfWeek = strtolower($currentDateTime->format('l'));

        // Ge the current course
        $course = \App\course::where('code', $data->input('courseID'))->first();
        // Get the current lecture also
        $lecture = $course->lecture()
            ->where('dayofweek', $dayOfWeek)
            ->where('starttime', '>=', $currentDateTime->format('h:i:s'))
            ->where('endtime', '<=', $currentDateTime->format('h:i:s'))
            ->first();

        // Check to see if there is an lecture in progress
        if (!$lecture->ActiveLecture) {
            return json_encode(["state" => "Change to fail", "Message" => "No active lecture instances"]);
        }
        //Get the list of current lecutes this is an array,
        $lecture_instances = $lecture->getActiveLecture;
        foreach ($lecture_instances as $lecture_instance) {
            // Get the list of question active in the lecture
            $question = $lecture_instance->question;
        }


        if (is_null($lecture_instances) || empty($lecture_instances)) {
            $jsonResponse['state'] = "failure";
            $jsonResponse['message'] = "There's no active lecture now!";
            return json_encode($jsonResponse);
        } else if (empty($switcher->input('courseID'))) {

            $jsonResponse['state'] = "failure";
            $jsonResponse['message'] = "You have to register to a lecture first!";
            return json_encode($jsonResponse);
        } else {
            $question = $lecture_instances->question->first();
            if (is_null($question)) {
                $jsonResponse['state'] = "failure";
                $jsonResponse['message'] = "There's no questions asked at the moment!";
                return json_encode($jsonResponse);
            } else {
                $user = $switcher->input('username');
                $answer = $switcher->input('answer');
                DB::table('awnsers')->insert(
                    ['question_id' => $question->id, 'username' => $user, 'awnser' => $answer]
                );
                $jsonResponse['state'] = "success";
                $jsonResponse['message'] = "You have answered the question successfully! Thanks!";
                return json_encode($jsonResponse);
            }

        }


}
