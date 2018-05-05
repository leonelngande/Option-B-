<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sents', function(Blueprint $table)
		{
			$table->integer('patients_id')->index('i_fk_sents_patients');
			$table->integer('messages_id')->index('i_fk_sents_messages');
			$table->primary(['patients_id','messages_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sents');
	}

}
