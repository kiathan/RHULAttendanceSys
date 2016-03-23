<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $fillable = ["name", "code", "startdate", "enddate"];

    public function lecture()
    {
        return $this->hasMany(\App\lecture::class);
    }

    public function attachUser(\App\User $user, $role)
    {
        $user->saveCouse($this, $role);
    }

    public function user()
    {
        return $this->belongsToMany(\App\User::class);
    }
}
