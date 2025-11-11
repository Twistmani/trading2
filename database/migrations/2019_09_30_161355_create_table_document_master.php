<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumentMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
			$table->string('description',300);
			$table->date('issue_date');
			$table->date('expiry_date');
			$table->string('image',250);
			$table->tinyInteger('status');
			$table->string('code',45);
			$table->dateTime('created_at');
			$table->dateTime('deleted_at');
			$table->decimal('amount',10,2);
			$table->integer('department_id');
			
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
