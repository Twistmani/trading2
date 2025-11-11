<?php

use Illuminate\Database\Seeder;

class FormDetailsadvanceBalanaceIsrv extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_details')->insert([
		   'form_id' => 1,
		   'field_code' => 'advance',
		   'field_name' => 'Advance',
		   'active' => 0,
		   'status' => 1
		 ],
		 [
			'form_id' => 1,
		   'field_code' => 'balance',
		   'field_name' => 'Balance',
		   'active' => 0,
		   'status' => 1
		],
		[
		   'form_id' => 1,
		   'field_code' => 'rv_entry',
		   'field_name' => 'Receipt Voucher Entry',
		   'active' => 0,
		   'status' => 1
		]
	   );
	   
    }
}
