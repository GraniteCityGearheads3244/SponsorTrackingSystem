<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorPlaceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'sponsor_places';

    /**
     * Run the migrations.
     * @table sponsor_place
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('zip', 45);
            $table->string('country', 100)->nullable();
            $table->char('type', 4);
            $table->boolean('is_primary');
            $table->unsignedInteger('sponsor_id')->nullable();

            $table->index(["sponsor_id"], 'fk_sponsor_place_sponsor_idx');


            $table->foreign('sponsor_id', 'fk_sponsor_place_sponsor_idx')
                ->references('id')->on('sponsors')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->softDeletes();
            $table->timeStamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
