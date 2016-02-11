<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecture_instend extends Model
{
    public function venue()
    {
        return $this->belongsTo(\App\venue::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\course::class);
    }

    public function lecture()
    {
        return $this->belongsTo(\App\lecture::class);
    }
}
