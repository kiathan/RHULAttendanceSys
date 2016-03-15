<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Carbon\Carbon;

class create_lecture_instance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_lecture_instance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check to see if there is any lectures that need starting or stoping';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $currentTime = new Carbon();
        printf("-----------------------------------------------------------------------\n");
        printf("start on update the lectures : %s\n\n", $currentTime->format('y-m-d:H:i:s'));
        // Offset in minuest
        $offset = 10;
        $dayToDay = strtolower($currentTime->format('l'));
        $currentTime->addMinutes($offset);
        $starttime = $currentTime->format("h:i:s");
        $currentTime->addMinutes((($offset * 2) * -1));
        $endtime = $currentTime->format("h:i:s");

        $lecturesToStart = \App\lecture::where("dayofweek", $dayToDay)->where('starttime', '<=', $starttime)->where('endtime', '>=', $endtime)->get();

        foreach ($lecturesToStart as $lecture) {
            if (!$lecture->hasActiveLecture()) {
                $lecture->activeLectureInstance();
                printf("\tStart lecture %s\n", $lecture->course->code);
            }
        }

        $lecturesToEnd = \App\lecture::where('dayofweek', $dayToDay)->where('endtime', '<=', $endtime)->get();
        foreach ($lecturesToEnd as $lecture) {
            if ($lecture->hasActiveLecture()) {
                $lecture->deactiveLectureInstance();
                printf("\tStop lecture %s\n", $lecture->course->code);
            }
        }
        printf("end the update the lectures: %s\n", $currentTime->format('y-m-d:H:i:s'));
        printf("-----------------------------------------------------------------------\n");
    }
}
