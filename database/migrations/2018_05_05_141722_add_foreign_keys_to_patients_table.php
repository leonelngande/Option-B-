<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patients', function(Blueprint $table)
		{
			$table->foreign('drugs_id', 'fk_patients_drugs')->references('id')->on('drugs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('users_id', 'fk_patients_users')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patients', function(Blueprint $table)
		{
			$table->dropForeign('fk_patients_drugs');
			$table->dropForeign('fk_patients_users');
		});
	}

}
