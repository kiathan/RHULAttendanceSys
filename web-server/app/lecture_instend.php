<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecture_instend extends Model
{
    protected $fillable = ["lecture_id", "isActive"];
    protected $table = "lecture_instend";

    public function lecture()
    {
        return $this->belongsTo(\App\lecture::class);
    }

    public function question()
    {
        return $this->hasMany(\App\question::class);
    }


    public function createHash()
    {
        return hash("sha256", $this->id . "" . $this->created_at);
    }

    public function sendQRcode($size = 250)
    {
        return \QrCode::format('svg')->size($size)->generate($this->createHash());

    }

    public function checkQRcode($qrCodeEntrey)
    {
        return $this->createHash() == $qrCodeEntrey;
    }

    public function attendentsSignin()
    {
        return $this->belongsToMany(\App\User::class, 'lecture_user');
    }

    public function createQuestion()
    {

    }


}
