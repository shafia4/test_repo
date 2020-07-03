<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Asset;
use App\Inherer;
use App\Inhereracess;
use App\Liability;
use App\Currency;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','street','city','country','currency_id','telnr','role_id','plan_id','paiduntil'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function asset()
    {

        return $this->hasMany('App\Asset');
    }

    

    public function liability()
    {

        return $this->hasMany('App\Liability');
    }

    public function role()
    {

        return $this->belongsTo('App\Role');
    }

    public function currency()
    {

        return $this->belongsTo('App\Currency');
    }


    public function inherer()
    {

        return $this->hasMany('App\Inherer');
    }
}
