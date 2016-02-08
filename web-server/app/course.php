<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    public function lecture()
    {
        return $this->belongsTo(\App\lecture::class);
    }

    public function user()
    {
        return $this->belongsToMany(\App\user::class);
    }
}
