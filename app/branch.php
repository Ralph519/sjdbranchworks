<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    public function employee()
    {
        return $this->belongsTo('App\branch');  
    }
}
