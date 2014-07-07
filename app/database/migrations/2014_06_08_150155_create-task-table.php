<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('task', function($table) {
			$table->increments('id');
			$table->string('name', 250);
			$table->text('description');
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('priority')->unsigned();
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

		Schema::table('task', function($table) {
			$table->dropForeign('task_user_id_foreign');
		});

		Schema::drop('task');
	}

}
