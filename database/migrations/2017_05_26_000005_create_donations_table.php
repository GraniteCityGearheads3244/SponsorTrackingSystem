<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'donations';

    /**
     * Run the migrations.
     * @table donations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('amount');
            $table->date('date_recieved');
            $table->unsignedInteger('sponsor_id')->nullable();

            $table->index(["sponsor_id"], 'fk_donations_sponsor_idx');


            $table->foreign('sponsor_id', 'fk_donations_sponsor_idx')
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
