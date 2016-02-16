<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class awnser extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\user::class);
    }

    public function question()
    {
        return $this->belongsTo(\App\question::class);
    }

    public static function getAnwnsersByUser()
    {

    }


}
