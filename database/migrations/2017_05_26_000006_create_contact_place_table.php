<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactPlaceTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'contact_places';

    /**
     * Run the migrations.
     * @table contact_place
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('type', 4);
            $table->tinyInteger('is_primary');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('zip', 16);
            $table->string('country', 100)->nullable();
            $table->unsignedInteger('contact_id')->nullable();

            $table->index(["contact_id"], 'fk_contact_place_contact_idx');


            $table->foreign('contact_id', 'fk_contact_place_contact_idx')
                ->references('id')->on('contacts')
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
