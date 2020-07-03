<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [

    'partner_id' ,'asset_id','path'];
}
