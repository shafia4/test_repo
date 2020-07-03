<?php

namespace App;

use App\Partner;
use App\Asset;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{

    protected $fillable = ['asset_id','partner_id','name','path',
    'value' ,'storedlocation', 'agreedon' ,'termination','reminderterm','reminderreg'];

    public function partner()
    {

        return $this->belongsToMany('App\Partner');
    }

    public function Asset()
    {

        return $this->belongsTo('App\Asset');
    }
}
