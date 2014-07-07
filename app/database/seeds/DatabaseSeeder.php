<?php

use Toomdrix\Pm\Configuration;
use Toomdrix\Pm\Company;
use Toomdrix\Pm\Usergroup;
use Toomdrix\Pm\Project;
use Toomdrix\Pm\ProjectCategory;
use Toomdrix\Pm\Milestone;
use Toomdrix\Pm\Task;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ConfigurationSeeder');
		$this->call('CompanySeeder');
		$this->call('UsergroupSeeder');
		$this->call('UserSeeder');
		$this->call('ProjectCategorySeeder');
		$this->call('ProjectSeeder');
		$this->call('MilestoneSeeder');
		$this->call('TaskSeeder');
	}

}

class ConfigurationSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('config')->delete();
        Configuration::create(array(
        	'key'=>'num_list_items',
        	'value'=>5
        	));

        Configuration::create(array(
        	'key'=>'priority_list',
        	'value'=>'{"1":"High","2":"Medium","3":"low"}'
        	));

	}

}

class UsergroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('usergroup')->delete();
        Usergroup::create(array(
        	'name'=>'Administrators'
        	));

       	Usergroup::create(array(
        	'name'=>'Internal'
        	));

       	Usergroup::create(array(
        	'name'=>'External'
        	));
	}

}

class CompanySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('company')->delete();
        Company::create(array(
        	'name'=>'Fluid Creativity' ,
        	'phone'=>'0161 368 9814',
        	'email' => 'info@fluidcreativity.co.uk'
        ));

        Company::create(array(
        	'name'=>'Whitecroft Lighting Ltd' ,
        	'phone'=>'0161 666 7777',
        	'email' => 'info@whitecroftlighting.com'
        ));
	}

}

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
        User::create(array(
        	'firstname'=>'Adrian',
        	'lastname'=>'Toomer',
        	'email' => 'adrian@fluid.com',
        	'company_id'=> Company::where('name', '=', 'Fluid Creativity')->first()->id,
        	'usergroup_id'=> Usergroup::where('name', '=', 'Administrators')->first()->id,
        	'password'=>Hash::make('testing')
        	));

        User::create(array(
        	'firstname'=>'Paul',
        	'lastname'=>'Rafter',
        	'email' => 'paul@fluid.com',
        	'company_id'=> Company::where('name', '=', 'Fluid Creativity')->first()->id,
        	'usergroup_id'=> Usergroup::where('name', '=', 'Internal')->first()->id,
        	'password'=>Hash::make('testing')
        	));

        User::create(array(
        	'firstname'=>'Andrew',
        	'lastname'=>'Braithwaite',
        	'email' => 'andrew@whitecroftlighting.com',
        	'company_id'=> Company::where('name', '=', 'Whitecroft Lighting Ltd')->first()->id,
        	'usergroup_id'=> Usergroup::where('name', '=', 'External')->first()->id,
        	'password'=>Hash::make('testing')
        	));
	}

}

class ProjectCategorySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('project_category')->delete();
        ProjectCategory::create(array(
        	'name'=>'Magento' 
        ));

        ProjectCategory::create(array(
        	'name'=>'Joomla' 
        ));

        ProjectCategory::create(array(
        	'name'=>'Wordpress' 
        ));
	}

}

class ProjectSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('project')->delete();
        Project::create(array(
        	'name'=>'Whitecroft Lighting Joomla Build' ,
        	'company_id'=>Company::where('name', '=', 'Whitecroft Lighting Ltd')->first()->id,
        	'project_category_id'=>ProjectCategory::where('name', '=', 'Joomla')->first()->id,
        ));

        Project::create(array(
        	'name'=>'New Fluid Site 2014' ,
        	'company_id'=>Company::where('name', '=', 'Fluid Creativity')->first()->id,
        	'project_category_id'=>ProjectCategory::where('name', '=', 'Wordpress')->first()->id,
        ));
	}

}

class MilestoneSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('milestone')->delete();
        Milestone::create(array(
        	'name'=>'Initial Build',
        	'description'=>'Deliver the initial build to the client',
        	'start_date'=>'2014-09-20',
        	'end_date'=>'2014-10-20',
        	'project_id'=>Project::where('name', '=', 'New Fluid Site 2014')->first()->id,
        ));
	}

}

class TaskSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('task')->delete();
        Task::create(array(
        	'name'=>'HTML Build',
        	'description'=>'Build the HTML',
        	'start_date'=>'2014-10-10',
        	'end_date'=>'2014-10-20',
        	'priority'=>1,
        	'user_id'=>User::where('firstname', '=', 'Adrian')->first()->id,
        	'milestone_id'=>Milestone::where('name', '=', 'Initial Build')->first()->id,
        ));
	}

}