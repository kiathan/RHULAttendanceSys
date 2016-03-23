<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Carbon\Carbon;

class create_test_lecture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_test_lecture';

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

        printf("Enter the course code that the lecture will belong to\n");
        $line = fgets($userInput);
        $courseCode = trim($line);
        $course = \App\course::where('code', $courseCode)->first();

        printf("Enter the day of week (1-7)\n");
        $line = fgets($userInput);
        $dayofweek = "";
        switch (trim($line)) {
            case 1:
                $dayofweek = "monday";
                break;
            case 2:
                $dayofweek = "tuesday";
                break;
            case 3:
                $dayofweek = "wednesday";
                break;
            case 4:
                $dayofweek = "thursday";
                break;
            case 5:
                $dayofweek = "friday";
                break;
            case 6:
                $dayofweek = "saturday";
                break;
            case 7:
                $dayofweek = "sunday";
                break;
        }

        printf("Enter the start of the lectuer hh:mm:ss format\n");
        $line = fgets($userInput);
        $starttime = trim($line);

        printf("Enter the end of the lectuer hh:mm:ss format\n");
        $line = fgets($userInput);
        $endtime = trim($line);

        $lecture = new \App\lecture();
        $lecture->course_id = $course->id;
        $lecture->venue_id = 1;
        $lecture->dayofweek = $dayofweek;
        $lecture->starttime = $starttime;
        $lecture->endtime = $endtime;
        $lecture->save();

        printf("Create an new lecture");

    }
}
