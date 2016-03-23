<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Carbon\Carbon;

class create_test_questionWithAwnsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_test_questionWithAwnsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an lecture';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userInput = fopen("php://stdin", "r");

        $lci = \App\lecture_instend::where('isActive', 'true')->with(['lecture'])->get();

        $number = $lci->count();

        if ($number == 0) {
            printf("No lecture to reslect from\n");
            return;
        }

        printf("select an lecture instance to create an question to from 1 to %d\n", $number);
        $count = 1;
        foreach ($lci as $li) {
            printf("%d) coruse code %s, start at %s and ends at %s\n", $count, $li->lecture->course->code, $li->lecture->starttime, $li->lecture->endtime);
            ++$count;
        }

        $result = fgets($userInput);

        $lectureCount = trim($result);

        $li = $lci->all()[$result - 1];
        $question = NULL;

        if ($li->question()->where('isValit', true)->count() > 0) {
            printf("Create a new question [y/n]\n");
            $line = fgets($userInput);
            if (trim($line) == "y") {
                $question = $li->question()->where('isValit', true)->first();
                $question->isValit = false;
                $question->save();

                $question = new \App\question();
                $question->lecture_instend_id = $li->id;
                $question->isValit = true;
                $question->save();
            } else {
                $question = $li->question()->where('isValit', true)->first();
            }
        } else {
            $question = new \App\question();
            $question->lecture_instend_id = $li->id;
            $question->isValit = true;
            $question->save();
        }
        $possibleAwnsers = collect(['A', 'B', 'C', 'D']);


        foreach (\App\User::all() as $user) {
            if ($question->awnser->where('user_id', $user->id)->count() > 0) {
                $awnsers = $question->awnser->where('user_id', $user->id)->first();
            } else {
                $awnsers = new \App\awnser();
                $awnsers->question_id = $question->id;
                $awnsers->user_id = $user->id;
                $awnsers->isValit = true;
            }
            $result = $possibleAwnsers->random();
            $awnsers->awnser = $result;

            $awnsers->save();
        }

    }
}
