<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInSalesInvoiceItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_invoice_item', function ($table) {
			$table->tinyInteger('item_type');
			$table->float('pay_pcntg',8,2);
			$table->decimal('pay_amount',10,2);
			$table->string('pay_pcntg_desc',250);
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
