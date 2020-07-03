<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Currency;
use App\Contract;
use App\User;
use Auth;

class Liability extends Model
{


     protected $fillable = [

    'name','user_id','agreementdate','contractnr','creditor','currentvalue','initialvalue','interest','enddate','notes','liabilitytype','currency_id'

     ];

     public function liabilityselect()
     {

         $liability = ['Kreditkarte','Wohnbaukredit','Privatkredit','Gehaltsvorauszahlung','Konsumentenkredit','sonstiges'];


         for ($x = 0; $x < count($liability); $x++) {
             echo "<option value='";
             echo $liability[$x];
             echo"'>";
             echo $liability[$x];
             echo"</option>";
         }
     }
     public function contract()
     {

         return $this->hasMany('App\Contract');
     }

     public function currency()
     {

         return $this->belongsTo('App\Currency');
     }

     public function user()
     {

         return $this->belongsTo('App\User');
     }
     
     public function liability()
    {

        return $this->belongsTo('App\Asset');
    }
};
