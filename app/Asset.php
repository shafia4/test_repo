<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Immo;
use App\Assettype;
use App\Document;
use App\Liability;
use App\Photo;
use App\Currency;
use App\Partner;
use App\Assetusage;
use App\User;
use Lang;

class Asset extends Model
{
    protected $fillable = [

    'name','value','user_id','assetusage_id','assettype_id','liability_id','street','city','costs','revenue','enddate','interest','term','initialinvestment','brand','purchasedate','valuebase','notes','artist','milage','licenseplate','serialnr','artist','currency_id',

    ];

    public function immo()
    {

        return $this->hasOne('App\Immo');
    }

    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function assettype()
    {

        return $this->belongsTo('App\Assettype');
    }

    public function assetusage()
    {

        return $this->belongsTo('App\Assetusage');
    }

    public function liability()
    {

        return $this->belongsTo('App\Liability');
    }

    


    public function document()
    {

        return $this->hasMany('App\Document');
    }

    public function photo()
    {

        return $this->hasMany('App\Photo');
    }

    public function contract()
    {

        return $this->hasMany('App\Contract');
    }

    public function partner()
    {

        return $this->belongsToMany('App\Partner');
    }

    public function currency()
    {

        return $this->belongsTo('App\Currency');
    }

    public function valuebaseselect()
    {

        $valuebase = ['valbas.price','valbas.dcf','valbas.estimation','valbas.marketval','valbas.accountstatement','valbas.other'];
        $valuebaset = [Lang::get('valbas.price'),Lang::get('valbas.dcf'),Lang::get('valbas.estimation'),Lang::get('valbas.marketval'),Lang::get('valbas.accountstatement'),Lang::get('valbas.other')];



        for ($x = 0; $x < count($valuebase); $x++) {
            echo "<option value='";
            echo $valuebase[$x];

            echo "'>";
            echo $valuebaset[$x];
            echo"</option>";
        }
    }
}
