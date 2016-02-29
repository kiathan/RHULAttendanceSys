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

    public function ansQuiz(Request $data)
    {
        $student_inc = \App\User::find($data->input('user_id'));
        if (is_null($student_inc)) {
            return json_encode(['state' => 'fail', 'message' => 'No activate student id found.']);
        } else {
            $lecture_inc = \App\question::find($data->input('courseID'));
            if (is_null($lecture_inc)) {
                return json_encode(['state' => 'fail', 'message' => 'No activate question found.']);
            } else {
                $question = $data->input('courseID');
                $user = $data->input('user_id');
                $answer = $data->input('answer');


                DB::table('awnsers')->insert(
                    ['courseID' => $question, 'user_id' => $user, 'awnser' => $answer]
                );

                return json_encode(['state' => 'success', 'message' => 'You have answered question.']);
            }

        }
    }


    public function startNstop(Request $switcher)
    {
        $lecture_inc = \App\lecture_instend::find($switcher->input('courseID'));

        if (is_null($lecture_inc)) {
            return json_encode(['state' => 'fail', 'message' => 'No activate lecturer found.']);
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
