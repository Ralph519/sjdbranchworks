<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class issuetype extends Model
{
    public function ticket()
    {
      return $this->belongsTo('App\issuetype');
    }
}
