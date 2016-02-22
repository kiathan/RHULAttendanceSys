<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class venue extends Model
{
    protected $fillable = ["name", "address", "geoX", "geoY"];
    public function lecture()
    {
        return $this->belongsTo(\App\lecture::class);
    }

}