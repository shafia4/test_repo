<?php

namespace App;

use App\Contract;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [

    'asset_id','name','path',

    ];

    public function contract()
    {

        return $this->hasOne('App\Contract');
    }
}
