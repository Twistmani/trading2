<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParameter4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         /* Schema::create('parameter4', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('payroll_by');
			$table->float('nwh');
			$table->float('ot_general');
			$table->float('ot_holiday');
			$table->string('ot_calculation',45);
        }); */
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
