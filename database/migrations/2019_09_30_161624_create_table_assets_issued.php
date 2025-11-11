<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssetsIssued extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('assets_issued', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('name',150);
            $table->string('description',300);
            $table->date('issue_date');
            $table->tinyInteger('asset_status');
            $table->date('received_date');
            $table->string('othr_description',300);
			$table->tinyInteger('status');
			$table->dateTime('created_at');
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
