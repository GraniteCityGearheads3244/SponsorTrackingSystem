<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    //
    public function sponsor(){
      return $this->belongsTo('App\Sponsor');
    }
}
