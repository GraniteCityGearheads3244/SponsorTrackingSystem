<?php

use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Sponsor', 50)
          ->create()
          ->each(
            function ($s){
              $s->phones()->save(factory('App\Sponsor_phone')->make());
              $s->emails()->save(factory('App\Sponsor_email')->make());
              $s->addresses()->save(factory('App\Sponsor_place')->make());
              $s->donations()->save(factory('App\Donation')->make());

              $s->contacts()->save(factory('App\Contact', 2)->create()->each(
                    function ($c){
                      $c->phones()->save(factory('App\Contact_phone')->make());
                      $c->emails()->save(factory('App\Contact_email')->make());
                      $c->addresses()->save(factory('App\Contact_place')->make());
                    }
                  )
                );
            });
    }
}
