<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecture extends Model
{
    protected $fillable = ["course_id", "venue_id", "dayofweek", "starttime", "endtime"];


    public function venue()
    {
        return $this->belongsTo(\App\venue::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\course::class);
    }

    public function lecture_instance(){
        return $this->hasMany(\App\lecture_instend::class);
    }

    public function getActiveLecture(){
        return $this->lecture_instance()->where('isActive', '1');
    }
}
