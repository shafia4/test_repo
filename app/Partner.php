<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;
use App\Asset;

class Partner extends Model
{
    protected $fillable = [

    'name','contactperson','tel','user_id','street','city','email','reminder','passcode','idnumber'];


    public function photo()
    {

        return $this->hasMany('App\Photo');
    }

    public function asset()
    {

        return $this->belongsToMany('App\Asset');
    }

    public function contract()
    {

        return $this->hasMany('App\Contract');
    }
};
