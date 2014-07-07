<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('file', function($table) {
			$table->increments('id');
			$table->string('name', 250);
			$table->string('path', 250);
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
		Schema::table('file', function($table) {
			$table->dropForeign('file_user_id_foreign');
			$table->dropForeign('file_project_id_foreign');
		});

		Schema::drop('file');
	}

}