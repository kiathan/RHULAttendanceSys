<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use \KDuma\Permissions\Permissions;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Permissions {
        Authorizable::can insteadof Permissions;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'];


    public function course()
    {
        return $this->belongsToMany(\App\course::class)->withPivot("role")->withTimestamps();
    }

    public function attendnes()
    {
        return $this->belongsToMany(\App\lecture_instend::class, 'lecture_user');
    }


    public function checkIfAlreadyAttendnes(\App\lecture_instend $lecture_instend)
    {
        /*
         * Has one or more sign in on the current lecture instance
         */
        return ($this->attendnes()->find($lecture_instend->id) != null);
    }

    public function addAttendnes(\App\lecture_instend $lecture_instend)
    {
        return $this->attendnes()->withTimestamps()->attach($lecture_instend);

    }

    public function currentLectures()
    {
        $couresesAttending = $this->course()->get()->keys()->all();
        $currentTime = new Carbon();
        $day = strtolower($currentTime->format("l"));
        $time = $currentTime->format("G:i:s");
        return $lectures = \App\lecture::whereIn("course_id", $couresesAttending)->where("dayofweek", $day)->where("starttime", "<=", $time)->where("endtime", ">=", $time)->first();
    }

    public function getCurrentLectureInstance()
    {

        if (($lecture = $this->currentLectures()) == null) {
            return null;
        }


        return $lecture->getActiveLecture()->get();
    }

    public function allLectures()
    {
        $couresesAttending = $this->course()->get()->keys()->all();
        return $lectures = \App\lecture::whereIn("course_id", $couresesAttending)->get();

    }

    public function saveCouse(\App\course $course, $role)
    {
        return $this->course()->attach($course, ['role' => $role]);
    }

    public function checkToken($token = null)
    {
        if (is_null($token)) {
            return false;
        }

        return hash("sha256", $this->token) === $token;
    }
}
