<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    public function branch()
    {
        return $this->hasMany('App\branch','s_brnccode','s_brnccode');
    }

    public function user()
    {
      return $this->belongsTo('App\user');
    }

}
