<?php namespace Toomdrix\Pm;

class TaskController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Task::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.task.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('task.form');
		$form->action = array('action' => 'Toomdrix\Pm\TaskController@store', 'class'=>'form-signup');
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
		$task = Task::find($id);
		$this->layout->title = $task->name;

		//$users = \View::make('common/list');
		//$users->items = $task->users()->paginate();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'Overview' => 'Overview',
				'Tasks' => 'Tasks',
				'Milestones' => 'Milestones',
				'Messages' => 'Messages',
				'Files' => 'Files',
				'Time' => 'Time',
				'Notebook' => 'Notebook',
				'Billing' => 'Billing',
				'People' => 'People'
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
			return $this->getRedirect()
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			$start_date = \DateTime::createFromFormat('d/m/Y', $_POST['start_date']);
			$end_date = \DateTime::createFromFormat('d/m/Y', $_POST['end_date']);
			// store
			$task = new Task;
			$task->name  = \Input::get('name');
			$task->description  = \Input::get('description');
			$task->priority = \Input::get('priority');
			$task->user_id = \Input::get('user_id');
			$task->milestone_id = \Input::get('milestone_id');
			$task->start_date = $start_date->format("Y-m-d");
			$task->end_date = $end_date->format("Y-m-d");
			$task->save();

			// redirect
			\Flash::push('success', 'Successfully created task!');

			return $this->getRedirect();
		}
	}

	private function validate($update = false) {
		$rules = array(
			'name'  => 'required',
			'description'  => 'required'
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
		$form = \View::make('task.form');
		$form->task = Task::find($id);
		$form->action = array('action' => array('Toomdrix\Pm\TaskController@update', $form->task->id),'class'=>'form-signup');
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
			return $this->getRedirect()
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			$start_date = \DateTime::createFromFormat('d/m/Y', $_POST['start_date']);
			$end_date = \DateTime::createFromFormat('d/m/Y', $_POST['end_date']);
			// store
			$task = Task::find($id);
			$task->name  = \Input::get('name');
			$task->description  = \Input::get('description');
			$task->priority = \Input::get('priority');
			$task->user_id = \Input::get('user_id');
			$task->milestone_id = \Input::get('milestone_id');
			$task->start_date = $start_date->format("Y-m-d");
			$task->end_date = $end_date->format("Y-m-d");
			$task->save();

			// redirect
			\Flash::push('success', 'Successfully updated task!');
			return $this->getRedirect();
		}
	}

}
