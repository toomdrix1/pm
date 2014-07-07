<?php namespace Toomdrix\Pm;

class TimeController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Time::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.time.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('time.form');
		$form->action = array('action' => 'Toomdrix\Pm\TimeController@store', 'class'=>'form-signup');
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
		$time = Time::find($id);
		$this->layout->title = $time->name;

		//$users = \View::make('common/list');
		//$users->items = $time->users()->paginate();

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
			return \Redirect::to('time')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$time = new Time;
			$time->name  = \Input::get('name');
			$time->company_id = \Input::get('company_id');
			$time->save();

			// redirect
			\Flash::push('success', 'Successfully created time!');

			return \Redirect::to('time');
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
		$form = \View::make('time.form');
		$form->time = Time::find($id);
		$form->action = array('action' => array('Toomdrix\Pm\TimeController@update', $form->time->id),'class'=>'form-signup');
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
			return \Redirect::to('time')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			$start_date = \DateTime::createFromFormat('d/m/Y', $_POST['start_date']);
			$end_date = \DateTime::createFromFormat('d/m/Y', $_POST['end_date']);
			// store
			$time = Time::find($id);
			$time->name  = \Input::get('name');
			$time->company_id = \Input::get('company_id');
			$time->start_date = $start_date->format("Y-m-d");
			$time->end_date = $end_date->format("Y-m-d");
			$time->save();

			// redirect
			\Flash::push('success', 'Successfully updated time!');
			return \Redirect::to('time');
		}
	}


}
