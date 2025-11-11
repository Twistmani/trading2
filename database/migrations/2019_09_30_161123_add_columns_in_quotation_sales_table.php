<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInQuotationSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('quotation_sales', function ($table) {
			$table->tinyInteger('job_type');
			$table->tinyInteger('jobnature');
			$table->string('fabrication',200);
			$table->string('prefix',15);
			$table->string('kilometer',45);
			$table->text('footer_text');
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
