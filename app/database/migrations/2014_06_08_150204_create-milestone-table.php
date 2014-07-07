<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestoneTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('milestone', function($table) {
			$table->increments('id');
			$table->string('name', 250);
			$table->text('description');
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('project');
			$table->timestamps();
		});

		Schema::table('task', function($table) {
			$table->integer('milestone_id')->unsigned();
			$table->foreign('milestone_id')->references('id')->on('milestone');
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
			$table->dropForeign('task_milestone_id_foreign');
		});

		Schema::table('milestone', function($table) {
			$table->dropForeign('milestone_project_id_foreign');
		});

		Schema::drop('milestone');
	}

}