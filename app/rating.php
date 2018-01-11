<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
  public function ticket()
  {
      return $this->belongsTo('App\ticket');  
  }
}
