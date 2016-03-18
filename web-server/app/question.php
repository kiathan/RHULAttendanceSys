<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class question extends Model
{
    protected $appends = ['result'];

    public function awnser()
    {
        return $this->hasMany(\App\awnser::class);
    }

    public function lecture()
    {
        return $this->belongsTo(\App\lecture_instend::class);
    }

    public function takeOffline()
    {

    }

    public function setResultAttribute()
    {
        return $this->awnser()->groupBy('awnser')->get(['awnser', DB::raw('count(*)')]);
    }

    public function getResultAttribute()
    {
        return $this->awnser()->groupBy('awnser')->get(['awnser', DB::raw('count(*)')]);
    }
}
