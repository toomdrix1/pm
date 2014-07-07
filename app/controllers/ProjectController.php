<?php namespace Toomdrix\Pm;

class ProjectController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Project::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.project.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('project.form');
		$form->action = array('action' => 'Toomdrix\Pm\ProjectController@store', 'class'=>'form-signup');
		return $form;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = Project::find($id);

		\Session::put('active_project', $project->id);

		$this->layout->title = $project->name;

		$tasks = \View::make('common/list');
		$tasks->items = $project->tasks()->get(array('task.*'));

		$milestones = \View::make('common/list');
		$milestones->items = $project->milestones()->get();

		$messages = \View::make('common/list');
		$messages->items = $project->messages()->get();
		\PM::log($messages->items);

		$files = \View::make('common/list');
		$files->items = $project->files()->get();

		$time = \View::make('common/list');
		$time->items = $project->time();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'Overview' => 'Overview',
				'Tasks' => $tasks,
				'Milestones' => $milestones,
				'Messages' => $messages,
				'Files' => $files,
				'Time' => $time,
				'Notebook' => 'Notebook',
				'Billing' => 'Billing',
				'People' => 'Users'
			);

		$this->layout->content = $view;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!$this->validate()) {
			return \Redirect::to('project')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$project = new Project;
			$project->name  = \Input::get('name');
			$project->company_id = \Input::get('company_id');
			$project->save();

			// redirect
			\Flash::push('success', 'Successfully created project!');

			return \Redirect::to('project');
		}
	}

	private function validate($update = false) {
		$rules = array(
			'name'  => 'required',
			'company_id'  => 'required',
			'start_date'  => 'required',
			'end_date'  => 'required',
			);

		$this->validator = \Validator::make(\Input::all(), $rules);

		// process the login
		return !$this->validator->fails();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form = \View::make('project.form');
		$form->project = Project::find($id);
		$form->action = array('action' => array('Toomdrix\Pm\ProjectController@update', $form->project->id),'class'=>'form-signup');
		return $form;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (!$this->validate(true)) {
			return \Redirect::to('project')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			$start_date = \DateTime::createFromFormat('d/m/Y', $_POST['start_date']);
			$end_date = \DateTime::createFromFormat('d/m/Y', $_POST['end_date']);
			// store
			$project = Project::find($id);
			$project->name  = \Input::get('name');
			$project->company_id = \Input::get('company_id');
			$project->start_date = $start_date->format("Y-m-d");
			$project->end_date = $end_date->format("Y-m-d");
			$project->save();

			// redirect
			\Flash::push('success', 'Successfully updated project!');
			return \Redirect::to('project');
		}
	}

}
