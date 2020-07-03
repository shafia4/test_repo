<?php

namespace App;

use App\Asset;
use App\Liability;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['tolead','name','leadcurrency','updated_at'];

    public function Asset()
    {

        return $this->hasOne('App\Asset');
    }

    public function Liability()
    {

        return $this->hasOne('App\Liability');
    }
}
