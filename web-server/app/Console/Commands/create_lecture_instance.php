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


        // Offset in minuest
        $offset = 10;
        $currentTime = new Carbon();
        $dayToDay = strtolower($currentTime->format('l'));
        $currentTime->addMinutes($offset);
        $currentClockTime = $currentTime->format("h:i:s");
        $lecturesToStart = \App\lecture::where("dayofweek", $dayToDay)->where('starttime', '<=', $currentClockTime)->get();

        foreach ($lecturesToStart as $lecture) {
            if (!$lecture->hasActiveLecture()) {
                $lecture->activeLectureInstance();
            }
        }
        //
        $currentTime->addMinutes((($offset * 2) * -1));
        $currentClockTime = $currentTime->format("h:i:s");
        $lecturesToEnd = \App\lecture::where('dayofweek', $dayToDay)->where('endtime', '>=', $currentClockTime)->get();
        foreach ($lecturesToEnd as $lecture) {
            if ($lecture->hasActiveLecture()) {
                $lecture->deactiveLectureInstance();
            }
        }
    }
}
