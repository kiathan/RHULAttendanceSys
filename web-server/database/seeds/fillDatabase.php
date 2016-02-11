<?php

use Illuminate\Database\Seeder;

class fillDatabase extends Seeder
{
    private $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker\Factory::create();

        $numberOfVenues = 50;
        $numberOfCours = 50;
        for ($i = 0; $i < $numberOfVenues; ++$i) {
            $this->makeVenu();
        }

        $venus = \App\venue::all();

        for ($i = 0; $i < $numberOfCours; ++$i) {
            $course = $this->makeCouse();
            for ($j = 0; $j < 3; ++$j) {
                $venu = $venus[rand(0, 49)];
                $this->makeLectures($course, $venu);
            }
        }


    }

    private function makeCouse()
    {
        $couse = new \App\course();
        $couse->name = $this->faker->name;;
        $couse->code = $this->faker->postcode;
        $couse->startdate = new Datetime("2015-09-11");
        $couse->enddate = new Datetime("2016-09-11");
        $couse->save();
        return $couse;
    }

    private function makeLectures(\App\course $course, \App\venue $venue, $amount = 1)
    {
        $weekDays = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
        shuffle($weekDays);
        for ($i = 0; $i < $amount; ++$i) {
            $lecture = new \App\lecture();
            $lecture->course_id = $course->id;
            $lecture->venue_id = $venue->id;
            $lecture->dayofweek = current($weekDays);
            $startTime = rand(9, 17);
            $lecture->starttime = $startTime . ":00:00";
            $lecture->endtime = ($startTime + 1) . ":00:00";
            next($weekDays);
            $lecture->save();
        }
    }

    private function makeVenu()
    {

        $venue = new \App\venue;

        $venue->name = $this->faker->streetName;
        $venue->address = $this->faker->address;
        $geo = $this->randCordRoyalHollway();
        $venue->geoX = $geo['latitude'];
        $venue->geoY = $geo['Longitude'];

        $venue->save();
        return $venue;
    }


    private function randCordRoyalHollway()
    {
        $latitude = 51.4257415;
        $Longitude = -0.5677479;

        $geo['latitude'] = $latitude + $this->rand(0.2, -0.1);
        $geo['Longitude'] = $Longitude + $this->rand(0.2, -0.1);

        return $geo;
    }

    private function rand($range, $offset = 0)
    {
        return ((mt_rand() / mt_getrandmax()) * $range) + $offset;
    }
}
