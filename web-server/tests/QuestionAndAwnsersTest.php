<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testQuestionAndAwnsers extends TestCase
{
    private static $user;
    private static $classCode;
    private static $dataformat = "y-m-d";

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreateQuestion()
    {
        $url = url('/api/quiz/lectureQuiz');
        $User = \App\User::where('username', 87654321)->first();
        $lecture_instances = $this->getCurrentLecture($User);
        $courese = $lecture_instances->lecture->course;
        $question = ["username" => 87654321, 'token' => "login", "courseID" => $courese->code, "state" => true];
        $result = $this->post($url, $question);
        var_dump($result);
        $this->assertTrue(true);
    }

    private function getCurrentLecture($user)
    {
        $lecture = $user->currentLectures();
        if ($lecture->count() == 0) {
            $cource = $user->course()->first();
            $datetime = new \Carbon\Carbon();
            $datetime->minute(0);
            $datetime->second(0);
            $venu = \App\venue::first();

            $dayofweek = strtolower($datetime->format('l'));
            //"course_id", "venue_id", "dayofweek", "starttime", "endtime"
            $lecture = new \App\lecture();
            $lecture->course_id = $cource->id;
            $lecture->venue_id = $venu->id;
            $lecture->dayofweek = $dayofweek;
            $lecture->starttime = $datetime->format("H:i:s");
            $datetime->addHour(1);
            $lecture->endtime = $datetime->format("H:i:s");
            $lecture->save();
        } else {
            $lecture = $lecture->get(0);

        }

        if (!$lecture->hasActiveLecture()) {
            $lecture->activeLectureInstance();
        }

        $lecInstances = $lecture->getActiveLecture()->with('lecture')->first();
        dd($lecture);
        return $lecInstances;
    }

}
