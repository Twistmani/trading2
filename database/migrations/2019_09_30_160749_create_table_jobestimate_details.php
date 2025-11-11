<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJobestimateDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('jobestimate_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobestimate_id');
			$table->text('description');
			$table->text('comment');
			$table->tinyInteger('status');
			$table->dateTime('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
