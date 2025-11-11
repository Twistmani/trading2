<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('vehicle', function ($table) {
			$table->string('issue_plate',100);
			$table->string('code_plate',85);
			$table->string('color_code',45);
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
		/* 







03-Sep-2019: bin,weight(modify type and char size) in itemmaster



*/
    }
}
