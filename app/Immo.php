<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Asset;

class Immo extends Model
{
     protected $fillable = [

    'asset_id','purchasedate','street','zipcode','geolocation','city','country','rented','yearlyincome','yearlycosts'

     ];

     public function asset()
     {

         return $this->belongsTo('App\Asset');
     }
}
