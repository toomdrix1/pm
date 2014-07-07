<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project', function($table) {
			$table->increments('id');
			$table->string('name', 250);
			$table->date('start_date');
			$table->date('end_date');
			$table->integer('company_id')->unsigned();
			$table->foreign('company_id')->references('id')->on('company');
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
		Schema::drop('project');
	}

}
