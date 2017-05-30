<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public function phones(){
      return $this->hasMany('App\Contact_phone');
    }
    public function emails(){
      return $this->hasMany('App\Contact_email');
    }
    public function addresses(){
      return $this->hasMany('App\Contact_place');
    }

    public function sponsors(){
      return $this->belongsToMany('App\Sponsor', 'sponsor_contact');
    }

}
