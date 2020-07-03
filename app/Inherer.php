<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Inhereracess;

class Inherer extends Model
{
     protected $fillable = [

    'name','prename','telnr','user_id','is_active','graceperiod','email','message','passcode'

     ];

     public function user()
     {

         return $this->belongsTo('App\User');
     }
}
