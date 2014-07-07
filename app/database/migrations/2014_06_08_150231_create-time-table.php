<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time', function($table) {
			$table->increments('id');
			$table->text('description');
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('billable');
			$table->integer('task_id')->unsigned();
			$table->foreign('task_id')->references('id')->on('task');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('time', function($table) {
			$table->dropForeign('time_user_id_foreign');
			$table->dropForeign('time_task_id_foreign');
		});

		Schema::drop('time');
	}

}