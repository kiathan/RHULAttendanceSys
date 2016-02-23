<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class quizController extends Controller
{

    public function ansQuiz(Request $data){
        $timestamps = false;
        $q = $data->input('question_id');
        $u = $data->input('user_id');
        $i = $data->input('isValit');


        DB::table('awnsers')->insert(
            ['question_id' => $q, 'user_id' => $u,'isValit'=>true,'awnser'=>true]
        );


        return $q . " ". $u." ".$i;


    }


    public function startNstop(Request $switcher){
         DB::table('questions')->where('courseID', $switcher->input('courseID'))->update(['isValit' => false]);
    }




}
