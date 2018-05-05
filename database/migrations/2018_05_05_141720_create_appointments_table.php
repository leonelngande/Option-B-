<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('patients_id')->index('i_fk_appointments_patients');
			$table->integer('users_id')->unsigned()->index('i_fk_appointments_users');
			$table->date('a_date');
			$table->string('frequency', 8);
			$table->string('a_status', 1)->nullable();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('appointments');
	}

}
