<?php

use Illuminate\Database\Seeder;

class fillDatabase extends Seeder
{
    private $faker;
    private $useCourseCode = array();

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker\Factory::create();

        $numberOfVenues = 50;

        for ($i = 0; $i < $numberOfVenues; ++$i) {
            $this->makeVenu();
        }
        $venus = \App\venue::all();
        $this->makeCouse($venus);
        $this->attachUsersToCoures();
    }

    private function makeCouse($venus)
    {
        $courseList = array(
            array("code" => "CS1801", "name" => "Object oriented programming"),
            array("code" => "CS1820", "name" => "Computing laboratory (robotics) "),
            array("code" => "CS1830", "name" => "Computing laboratory (games) "),
            array("code" => "CS1840", "name" => "Internet services "),
            array("code" => "CS1890", "name" => "Software design "),
            array("code" => "CS1860", "name" => "Mathematical structures "),
            array("code" => "CS1870", "name" => "Machine fundamentals "),
            array("code" => "CS2800", "name" => "Software engineering "),
            array("code" => "CS2810", "name" => "Team project "),
            array("code" => "CS2821", "name" => "Systems programming "),
            array("code" => "CS2830", "name" => "Robotics "),
            array("code" => "CS2844", "name" => "Computer graphics "),
            array("code" => "CS2850", "name" => "Operating systems "),
            array("code" => "CS2855", "name" => "Databases "),
            array("code" => "CS2860", "name" => "Algorithms and complexity "),
            array("code" => "IY2760", "name" => "Introduction to information security "),
            array("code" => "IY2840", "name" => "Computer and network Security "),
            array("code" => "CS3001", "name" => "Year out in industry "),
            array("code" => "CS3810", "name" => "Full unit project"),
            array("code" => "CS3821", "name" => "Full unit project"),
            array("code" => "CS3822", "name" => "Individual project in artificial intelligence"),
            array("code" => "IY3821", "name" => "Full unit project (Information Security) "),
            array("code" => "CS3110", "name" => "Bioinformatics "),
            array("code" => "CS3220", "name" => "Fundamentals of digital sound and music "),
            array("code" => "CS3230", "name" => "Computer games technology "),
            array("code" => "CS3250", "name" => "Visualisation and exploratory analysis "),
            array("code" => "CS3330", "name" => "Embedded and realtime systems "),
            array("code" => "CS3450", "name" => "Software verification "),
            array("code" => "CS3460", "name" => "Compiling for embedded systems "),
            array("code" => "CS3480", "name" => "Software language engineering "),
            array("code" => "CS3470", "name" => "Compilers and code generation "),
            array("code" => "CS3490", "name" => "Computational optimisation "),
            array("code" => "CS3510", "name" => "Functional programming and applications "),
            array("code" => "CS3580", "name" => "Advanced data communications "),
            array("code" => "CS3750", "name" => "Concurrent and parallel programming "),
            array("code" => "CS3870", "name" => "Advanced algorithms "),
            array("code" => "CS3920", "name" => "Computer learning "),
            array("code" => "CS3930", "name" => "Computational finance "),
            array("code" => "CS3940", "name" => "Intelligent agents and multi-agent systems "),
            array("code" => "IY3840", "name" => "Malicious software "),
            array("code" => "IY3660", "name" => "Applications of cryptography"),
            array("code" => "PS1021", "name" => "Learning and Memory"),
            array("code" => "PS1030", "name" => "Self and Society"),
            array("code" => "PS1060", "name" => "Biological Foundations of Psychology"),
            array("code" => "PS1110", "name" => "Introduction to Abnormal Psychology"),
            array("code" => "CR1011", "name" => "Introduction to Criminology"),
            array("code" => "CR1013", "name" => "Criminal Justice System"),
            array("code" => "PS2030", "name" => "Social Psychology"),
            array("code" => "PS2040", "name" => "Developmental Psychology"),
            array("code" => "PS2050", "name" => "Personality and Individual Differences"),
            array("code" => "PS2080", "name" => "Conceptual Issues in Psychology"),
            array("code" => "CR2010", "name" => "Research Methods for Psychologists"),
            array("code" => "CR2013", "name" => "Key Perspectives and Debates in Criminology"),
            array("code" => "CR2030", "name" => "Data Analysis for Psychologists"),
            array("code" => "PS2021", "name" => "Cognitive psychology"),
            array("code" => "PS2061", "name" => "Brain and Behaviour"),
            array("code" => "CR3025", "name" => "Dissertation (psychological focus)"),
            array("code" => "PS3022", "name" => "Language, Communication, and Thought "),
            array("code" => "PS3030", "name" => "Methods in Cognitive Neuroscience"),
            array("code" => "PS3041", "name" => "Advanced Developmental Psychology"),
            array("code" => "PS3050", "name" => "Health Psychology "),
            array("code" => "PS3060", "name" => "Perception and Awareness of the World and the Self "),
            array("code" => "PS3061", "name" => "The Ageing Brain "),
            array("code" => "PS3090", "name" => "Advanced and Applied Social Psychology "),
            array("code" => "PS3110", "name" => "Adult Psychological Problems "),
            array("code" => "PS3121", "name" => "Developmental Disorders "),
            array("code" => "PS3131", "name" => "Human Neuropsychology "),
            array("code" => "PS3141", "name" => "Clinical and Cognitive Neuroscience"),
            array("code" => "PS3151", "name" => "Occupational and Organisational Psychology"),
            array("code" => "PS3171", "name" => "Human Performance: Work, Sport and Medicine "),
            array("code" => "PS3181", "name" => "Criminal and Forensic Psychology "),
            array("code" => "PS3190", "name" => "Educational Psychology "),
            array("code" => "CR3003", "name" => "Youth in Society: Deviance and Delinquency "),
            array("code" => "CR3004", "name" => "Youth in Society: Culture, Subculture and Transgression "),
            array("code" => "CR3005", "name" => "Crime and the Media "),
            array("code" => "CR3006", "name" => "Crime and Literature Version 3.0"),
            array("code" => "CR3008", "name" => "Critical Readings in Criminology "),
            array("code" => "CR3009", "name" => "Race and Ethnicity in Contemporary Society "),
            array("code" => "CR3010", "name" => "Race, Crime and Justice "),
            array("code" => "CR3012", "name" => "Health Care: Sociological and Criminological Perspectives "),
            array("code" => "CR3020", "name" => "Risk Insecurity and Terrorism "),
            array("code" => "CR3024", "name" => "Health Care: Criminological and Sociological Perspectives"),
            array("code" => "CR3015", "name" => "Children, Society and Risk"),
            array("code" => "CR3023", "name" => "Prisons"));
        foreach ($courseList as $courseEntry) {
            $couse = new \App\course();
            $couse->name = $courseEntry['name'];
            $couse->code = $courseEntry['code'];

            $couse->startdate = new Datetime("2015-09-11");
            $couse->enddate = new Datetime("2016-09-11");
            $couse->save();

            for ($j = 0; $j < 3; ++$j) {
                $venu = $venus[rand(0, 49)];
                $this->makeLectures($couse, $venu);

            }
        }
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


        $geo = $this->randCordRoyalHollway();
        $venue->name = $geo['name'];
        $venue->address = $geo['address'];
        $venue->geoX = $geo['latitude'];
        $venue->geoY = $geo['logngitude'];

        $venue->save();
        return $venue;
    }

    private function venuName()
    {
        $prefixList = ["Born Building", "THe hub", "Maccrre", "Founters"];
        return array_rand($prefixList, 1);
    }


    private function randCordRoyalHollway()
    {
        $venus = array(
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Moore Building", "name" => "Moore Building", "latitude" => 51.426582, "logngitude" => -0.565304),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Horton Building", "name" => "Horton Building", "latitude" => 51.426492, "logngitude" => -0.563919),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Founders' Building", "name" => "Founders' Building", "latitude" => 51.424845, "logngitude" => -0.566686),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, McCrea Building", "name" => "McCrea Building", "latitude" => 51.426166, "logngitude" => -0.564366),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Bourne Building", "name" => "Bourne Building", "latitude" => 51.426277, "logngitude" => -0.562965),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Bourne Annex", "name" => "Bourne Annex", "latitude" => 51.425974, "logngitude" => -0.562471),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Queen's Building", "name" => "Queen's Building", "latitude" => 51.426424, "logngitude" => -0.561508),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Boiler house", "name" => "Boiler house", "latitude" => 51.427116, "logngitude" => -0.564744),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, International Building", "name" => "International Building", "latitude" => 51.427537, "logngitude" => -0.563929),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Windsor Building", "name" => "Windsor Building", "latitude" => 51.425799, "logngitude" => -0.565743),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Arts Building", "name" => "Arts Building", "latitude" => 51.425965, "logngitude" => -0.564733),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, John Boyer Building", "name" => "John Boyer Building", "latitude" => 51.425950, "logngitude" => -0.561543),
            array("address" => "Egham, Surrey TW20 0EX, Royal Hollway, Computer Center", "name" => "Computer Center", "latitude" => 51.426310, "logngitude" => -0.56572),
        );
        $latitude = 51.4257415;
        $logngitude = -0.5677479;

        $geo['latitude'] = $latitude + $this->rand(0.2, -0.1);
        $geo['logngitude'] = $logngitude + $this->rand(0.2, -0.1);

        return $venus[array_rand($venus, 1)];
    }

    private function rand($range, $offset = 0)
    {
        return ((mt_rand() / mt_getrandmax()) * $range) + $offset;
    }

    private function attachUsersToCoures()
    {
        $numberOfUsers = \App\User::count();
        $numberOfCoures = \App\User::count();
        $users = \App\User::all();
        for ($j = 0; $j < $numberOfUsers; ++$j) {
            $user = $users[$j];
            for ($i = 0; $i < 5; ++$i) {
                $Course = \App\course::find(rand(1, $numberOfCoures));
                $user->saveCouse($Course, 'student');
            }
        }
    }
}
