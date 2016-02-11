<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecture extends Model
{
    public function venue()
    {
        return $this->belongsTo(\App\venue::class);
    }

    public function course()
    {
        return $this->belongsTo(\App\course::class);
    }
}
