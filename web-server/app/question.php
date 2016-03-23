<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class question extends Model
{
    protected $appends = ['result'];
    protected $hidden = ['lecture_instend_id', 'id', 'created_at', 'isValit', 'updated_at'];


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
        return $this->awnser()->groupBy('awnser')->get([DB::raw('TRIM(awnser) as awnser'), DB::raw('count(*)')]);
    }

    public function getResultAttribute()
    {
        return $this->awnser()->groupBy('awnser')->get([DB::raw('TRIM(awnser) as awnser'), DB::raw('count(*)')]);
    }
}
