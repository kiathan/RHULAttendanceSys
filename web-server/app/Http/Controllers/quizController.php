<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Query\Builder;

class quizController extends Controller
{

    public function ansQuiz(Request $data, Guard $auth)
    {
        if ($data->segment(1) == "api") {
            $data->all();
            $student_inc = \App\User::find($auth->user()->id);
            $lecture_instances = $user->getCurrentLectureInstance();

            if (is_null($student_inc)) {
                $jsonRespones['state'] = "failure";
                $jsonRespones['message'] = "Invalid student.";
                return json_encode($jsonRespones);
            } else if (is_null($lecture_instances) || empty($lecture_instances)) {
                $jsonRespones['state'] = "failure";
                $jsonRespones['message'] = "There's no active lecture now!";
                return json_encode($jsonRespones);
            }else {
                $lecture_inc = \App\question::find($data->input('courseID'));
                if (is_null($lecture_inc)) {
                    $jsonRespones['state'] = "failure";
                    $jsonRespones['message'] = "There's no questions asked at the moment!";
                    return json_encode($jsonRespones);
                } else {
                    $question = $data->input('courseID');
                    $user = $data->input('username');
                    $answer = $data->input('answer');


                    DB::table('awnsers')->insert(
                        ['courseID' => $question, 'username' => $user, 'awnser' => $answer]
                    );

                    $jsonRespones['state'] = "success";
                    $jsonRespones['message'] = "You have answered the question successfully! Thanks!";
                    return json_encode($jsonRespones);
                }

            }
        }
    }


    public function startNstop(Request $switcher)
    {
        $lecture_inc = \App\lecture_instend::find($switcher->input('courseID'));

        if (is_null($lecture_inc)) {
            return json_encode(['state' => 'failure', 'message' => 'No active lecturer found.']);
        } else {
            $question = \App\question::where('lecture_instend_id', $switcher->input('courseID'));
            $question = $question->first();
            if (is_null($question)) {
                $question = new \App\question;
                $question->lecture_instend_id = $switcher->input('courseID');
                $question->isValit = true;
                return json_encode(['state' => 'success', 'message' => 'Question added.']);
            } else {
                $question->isValit = !$switcher->input('state');
                $question->save();
                return json_encode(['state' => 'success', 'message' => 'Question state changed.']);
            }
        }
    }


}
