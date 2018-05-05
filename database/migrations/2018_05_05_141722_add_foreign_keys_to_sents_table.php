<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sents', function(Blueprint $table)
		{
			$table->foreign('messages_id', 'fk_sents_messages')->references('id')->on('messages')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('patients_id', 'fk_sents_patients')->references('id')->on('patients')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sents', function(Blueprint $table)
		{
			$table->dropForeign('fk_sents_messages');
			$table->dropForeign('fk_sents_patients');
		});
	}

}
