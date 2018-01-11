<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'empno', 'loginname', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employee()
    {
      return $this->hasMany('App\employee','s_employid','empno');
    }

    public function isAdmin()
    {
       return $this->isadmin == 'Y';
    }

    public function ticket()
    {
      return $this->belongsTo('App\ticket', 's_assignto');
    }

    public function reportbyname()
    {
      return $this-belongsTo('App\ticket', 's_reportby');
    }
}
