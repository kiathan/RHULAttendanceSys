<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lecture_instend extends Model
{
    protected $fillable = ["lecture_id" , "isActive"];
    protected $table = "lecture_instend";
    public function lecture()
    {
        return $this->belongsTo(\App\lecture::class);
    }

    public function question(){
        return $this->belongsTo(\App\question::class);
    }

    public function sendQRcode(){
        return hash("sha256", $this->id . "" . $this->created_at);
    }

    public function checkQRcode($qrCodeEntrey){
        return hash("sha256", $this->id . "" . $this->created_at) == $qrCodeEntrey;
    }

    public function attendentsSignin(){

    }

    public function createQuestion(){

    }


}
