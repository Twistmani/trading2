<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('resign', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
			$table->date('resign_date');  
			$table->decimal('airtkt_amount',10,2);
			$table->tinyInteger('resign_type');
			$table->float('months_worked',8,2);
			$table->float('cal_leave_days',8,2);
			$table->decimal('cal_leave_salary',10,2);
			$table->float('years_worked',8,2);
			$table->decimal('gratuity',10,2);
			$table->decimal('leave_advance',10,2);
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
