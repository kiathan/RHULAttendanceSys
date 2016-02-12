<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venue extends Model
{
    public function lecture()
    {
        return $this->belongsTo(\App\lecture::class);
    }
}
