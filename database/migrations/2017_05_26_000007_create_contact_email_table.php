<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactEmailTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'contact_emails';

    /**
     * Run the migrations.
     * @table contact_email
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
            $table->string('email');
            $table->unsignedInteger('contact_id')->nullable();

            $table->index(["contact_id"], 'fk_contact_email_contacts_idx');


            $table->foreign('contact_id', 'fk_contact_email_contacts_idx')
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
