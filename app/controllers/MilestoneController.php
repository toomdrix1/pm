<?php namespace Toomdrix\Pm;

class MilestoneController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Milestone::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.milestone.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('milestone.form');
		$form->project_id = \Session::get('active_project');
		$form->action = array('action' => 'Toomdrix\Pm\MilestoneController@store', 'class'=>'form-signup');
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
		$milestone = Milestone::find($id);
		$this->layout->title = $milestone->name;

		//$users = \View::make('common/list');
		//$users->items = $milestone->users()->paginate();

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
			->withInput();
		} else {
			// store
			$start_date = \DateTime::createFromFormat('d/m/Y', $_POST['start_date']);
			$end_date = \DateTime::createFromFormat('d/m/Y', $_POST['end_date']);
			
			$milestone = new Milestone;
			$milestone->name  = \Input::get('name');
			$milestone->description = \Input::get('description');
			$milestone->start_date = $start_date->format("Y-m-d");
			$milestone->end_date = $end_date->format("Y-m-d");
			$milestone->project_id = \Input::get('project_id');
			$milestone->save();

			// redirect
			\Flash::push('success', 'Successfully created milestone!');

			return $this->getRedirect();
		}
	}

	private function validate($update = false) {
		$rules = array(
			'name'  => 'required',
			'description'  => 'required',
			'start_date'  => 'required',
			'end_date'  => 'required',
			'project_id'  => 'required'
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
		$form = \View::make('milestone.form');
		$form->milestone = Milestone::find($id);
		$form->action = array('action' => array('Toomdrix\Pm\MilestoneController@update', $form->milestone->id),'class'=>'form-signup');
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
			->withInput();
		} else {
			$start_date = \DateTime::createFromFormat('d/m/Y', $_POST['start_date']);
			$end_date = \DateTime::createFromFormat('d/m/Y', $_POST['end_date']);
			// store
			$milestone = Milestone::find($id);
			$milestone->name  = \Input::get('name');
			$milestone->description = \Input::get('description');
			$milestone->start_date = $start_date->format("Y-m-d");
			$milestone->end_date = $end_date->format("Y-m-d");
			$milestone->project_id = \Input::get('project_id');
			$milestone->save();

			// redirect
			\Flash::push('success', 'Successfully updated milestone!');
			return $this->getRedirect();
		}
	}


}
