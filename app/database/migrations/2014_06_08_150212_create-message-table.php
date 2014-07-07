<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message', function($table) {
			$table->increments('id');
			$table->string('name', 250);
			$table->text('description');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('project');
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
		Schema::table('message', function($table) {
			$table->dropForeign('message_project_id_foreign');
			$table->dropForeign('message_user_id_foreign');
		});

		Schema::drop('message');
	}

}