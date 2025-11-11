<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInSalesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_order', function ($table) {
			$table->string('kilometer',45);
			$table->tinyInteger('job_type');
			$table->tinyInteger('jobnature');
			$table->string('fabrication',200);
			$table->string('prefix',200);
			$table->decimal('less_amount',10,2);
			$table->string('less_description',150);
			$table->string('previnv_description',150);
			$table->decimal('previnv_amount',10,2);
			$table->decimal('less_amount2',10,2);
			$table->string('less_description2',150);
			$table->decimal('less_amount3',10,2);
			$table->string('less_description3',150);
			$table->decimal('net_total_pay',10,2);
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
