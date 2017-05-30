<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_phone extends Model
{
    //
    public function contact(){
      return $this->belongsTo('App\Contact');
    }
}
