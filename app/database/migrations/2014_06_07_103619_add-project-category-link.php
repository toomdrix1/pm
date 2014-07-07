<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectCategoryLink extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project', function($table) {
			$table->integer('project_category_id')->unsigned();
			$table->foreign('project_category_id')->references('id')->on('project_category');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project', function($table) {
			$table->dropForeign('project_project_category_id_foreign');
            $table->dropColumn('project_category_id');
        });
	}

}
