<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class ticket extends Model
{
    public function branch()
    {
      return $this->hasMany('App\branch','s_brnccode', 's_brnccode');
    }

    public function ticketissues()
    {
      return $this->hasMany('App\issuetype','issuetype_code','issuetype');
    }

    public function user()
    {
      return $this->hasOne('App\user','loginname','s_assignto');
    }

    public function reportby()
    {
      return $this->hasOne('App\user','loginname','s_reportby');
    }

    public function rating()
    {
      return $this->hasOne('App\rating','rateable_id','id');
    }

    use Rateable;

}
