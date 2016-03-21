<?php

use Illuminate\Database\Seeder;

class create_make_attends extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get an list of students

        foreach (\App\lecture::all() as $lecture) {
            for ($i = 0; $i < 10; ++$i) {
                $lecture->activeLectureInstance();
                foreach ($lecture->course->user as $user) {
                    if (rand(0, 100) > 5) {
                        $lecinc = $lecture->getActiveLecture()->first();
                        $user->addAttendnes($lecinc);
                    }
                }
                $lecture->deactiveLectureInstance();
            }
        }
    }
}
