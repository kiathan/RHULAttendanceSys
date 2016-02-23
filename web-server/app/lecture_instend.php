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
        return $this->belongsTo(\App\question::class);
    }

<<<<<<< HEAD
    public function sendQRcode()
    {
        return \QrCode::format('svg')->generate(hash("sha256", $this->id . "" . $this->created_at));
=======
    public function createHash(){
        return hash("sha256", $this->id . "" . $this->created_at);
    }

    public function sendQRcode()
    {
        return \QrCode::format('svg')->size(250)->generate($this->createHash());
>>>>>>> Mobile-UI-(draft)
    }

    public function checkQRcode($qrCodeEntrey)
    {
<<<<<<< HEAD
        return hash("sha256", $this->id . "" . $this->created_at) == $qrCodeEntrey;
=======
        return $this->createHash() == $qrCodeEntrey;
>>>>>>> Mobile-UI-(draft)
    }

    public function attendentsSignin()
    {

    }

    public function createQuestion()
    {

    }


}
