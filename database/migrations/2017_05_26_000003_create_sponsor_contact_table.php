<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSponsorContactTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'sponsor_contact';

    /**
     * Run the migrations.
     * @table sponsor_contact
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->comment('	');
            $table->unsignedInteger('sponsor_id')->nullable();
            $table->unsignedInteger('contact_id')->nullable();

            $table->index(["sponsor_id"], 'fk_sponsor_contact_sponsors_idx');

            $table->index(["contact_id"], 'fk_sponsor_contact_contacts_idx');


            $table->foreign('contact_id', 'fk_sponsor_contact_contacts_idx')
                ->references('id')->on('contacts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('sponsor_id', 'fk_sponsor_contact_sponsors_idx')
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
