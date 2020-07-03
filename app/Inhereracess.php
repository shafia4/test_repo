<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Inherer;

class Inhereracess extends Model
{
     protected $fillable = [

    'user_id', 'inherer_id','acessed'

     ];

     public function inherer()
     {

         return $this->belongsToMany('App\Inherer', 'inhereracesses', 'id', 'inherer_id');
     }
}
