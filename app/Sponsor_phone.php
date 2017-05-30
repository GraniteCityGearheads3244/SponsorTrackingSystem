<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor_phone extends Model
{
    //

    public function sponsor(){
      return $this->belongsTo('App\Sponsor');
    }
}
