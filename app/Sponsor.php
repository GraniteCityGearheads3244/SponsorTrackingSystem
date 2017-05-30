<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    //
    public function phones(){
      return $this->hasMany('App\Sponsor_phone');
    }
    public function emails(){
      return $this->hasMany('App\Sponsor_email');
    }
    public function addresses(){
      return $this->hasMany('App\Sponsor_place');
    }
    public function donations(){
      return $this->hasMany('App\Donation');
    }
    public function contacts(){
      return $this->belongsToMany('App\Contact', 'sponsor_contact');
    }
}
