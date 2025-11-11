<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee', function ($table) {
			$table->string('me_id',100);
			$table->date('me_issue_date');
			$table->date('me_expiry_date');
			$table->string('me_image',300);
			$table->string('phone2',45);
			$table->float('lev_per_mth',8,2);
			$table->float('air_tkt',8,2);
			$table->float('anual_ml,8,2');
			$table->float('anual_cl',8,2);
			$table->date('rejoin_date');
			
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
