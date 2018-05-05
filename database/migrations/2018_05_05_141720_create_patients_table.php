<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('drugs_id')->index('i_fk_patients_drugs');
			$table->integer('users_id')->unsigned()->index('i_fk_patients_users');
			$table->string('given_name', 128);
			$table->string('surname', 128);
			$table->string('marital_status', 7);
			$table->char('gender', 1);
			$table->date('dob');
			$table->string('phone', 9);
			$table->string('other_phone', 9)->nullable();
			$table->string('address', 128)->nullable();
			$table->string('email', 128)->nullable();
			$table->string('transfered', 1)->nullable();
			$table->timestamps();
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
		Schema::drop('patients');
	}

}
