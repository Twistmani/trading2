<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOnleave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onleave', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
			$table->date('start_date');
			$table->decimal('airtkt_amount',10,2);
			$table->float('alo_leave_days',8,2);
			$table->float('months_worked',8,2);
			$table->float('cal_leave_days',8,2);
			$table->decimal('cal_leave_salary',10,2);
			$table->decimal('leave_advance',10,2);
			$table->decimal('paid_leave_salary',10,2);
			$table->tinyInteger('leave_status');
			$table->tinyInteger('status');
			$table->dateTime('created_at');
			$table->dateTime('deleted_at');
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
