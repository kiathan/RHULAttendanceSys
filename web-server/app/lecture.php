<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class lecture extends Model
{
    protected $with = ["course", "venue", 'lecture_instance'];
    protected $fillable = ["course_id", "venue_id", "dayofweek", "starttime", "endtime"];
    protected $appends = ['UserAttended'];

    public function venue()
    {
        return $this->belongsTo(\App\venue::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\course::class);
    }


    public function lecture_instance()
    {
        return $this->hasMany(\App\lecture_instend::class);
    }

    public function getActiveLecture()
    {
        return $this->lecture_instance()->where('isActive', '1');
    }

    public function getUserAttendedAttribute()
    {
        $week = new \Carbon\Carbon();
        $user = Auth::user();
        $last_lecture_instances = $this->lecture_instance()->orderBy('created_at', 'desc')->where('created_at', '>=', $week->startOfWeek())->first();
        if (is_null($last_lecture_instances)) {
            return false;
        }

        if(is_null($user))
        {
            return false;
        }
        return $user->checkIfAlreadyAttendnes($last_lecture_instances);
    }

    public function setUserAttendedAttribute()
    {
        $week = new \Carbon\Carbon();
        $user = Auth::user();
        $last_lecture_instances = $this->lecture_instance()->orderBy('created_at', 'desc')->where('created_at', '>=', $week->startOfWeek())->first();
        if (is_null($last_lecture_instances)) {
            return false;
        }
        return $user->checkIfAlreadyAttendnes($last_lecture_instances);
    }

    public static function createRandomLecture(\App\User $user)
    {
        var_dump("testing");
        $countVenue = \App\venue::count();
        $coutes = $user->course()->first();
        $startTime = "00:00:00";
        $endTime = "23:59:59";
        foreach (array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday") as $dayOfWeek) {
            \App\lecture::create(["course_id" => $coutes->id, "venue_id" => rand(1, $countVenue), "dayofweek" => $dayOfWeek, "starttime" => $startTime, "endtime" => $endTime]);
        }

    }

}
