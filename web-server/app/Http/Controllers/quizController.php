<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \App\Question;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class quizController extends Controller
{

    public function ansQuiz(Request $data)
    {
        $question = $data->input('question_id');
        $user = $data->input('user_id');
        $answer = $data->input('answer');
        DB::table('awnsers')->insert(
            ['question_id' => $question, 'user_id' => $user, 'awnser' => $answer]
        );
    }


    public function startNstop(Request $switcher)
    {
       // DB::table('questions')->where('courseID', $switcher->input('courseID'))->update(['isValit' => false]);
        $question = \App\Question::where('courseID',$switcher->input('courseID'));
        $question->isValit = false;
        $question->save();
    }


}
