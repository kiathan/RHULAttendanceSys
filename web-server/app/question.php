<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    public function awnser()
    {
        return $this->hasMany(\App\awnser::class);
    }

    public function lecture()
    {
        return $this->belongsTo(\App\lecture::class);
    }
}
