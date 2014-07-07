<?php namespace Toomdrix\Pm;

class FileController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = File::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.file.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('file.form');
		$form->action = array('action' => 'Toomdrix\Pm\FileController@store', 'class'=>'form-signup');
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
		$file = File::find($id);
		$this->layout->title = $file->name;

		//$users = \View::make('common/list');
		//$users->items = $file->users()->paginate();

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
			return \Redirect::to('file')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$file = new File;
			$file->name  = \Input::get('name');
			$file->company_id = \Input::get('company_id');
			$file->save();

			// redirect
			\Flash::push('success', 'Successfully created file!');

			return \Redirect::to('file');
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
		$form = \View::make('file.form');
		$form->file = File::find($id);
		$form->action = array('action' => array('Toomdrix\Pm\FileController@update', $form->file->id),'class'=>'form-signup');
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
			return \Redirect::to('file')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			$start_date = \DateTime::createFromFormat('d/m/Y', $_POST['start_date']);
			$end_date = \DateTime::createFromFormat('d/m/Y', $_POST['end_date']);
			// store
			$file = File::find($id);
			$file->name  = \Input::get('name');
			$file->company_id = \Input::get('company_id');
			$file->start_date = $start_date->format("Y-m-d");
			$file->end_date = $end_date->format("Y-m-d");
			$file->save();

			// redirect
			\Flash::push('success', 'Successfully updated file!');
			return \Redirect::to('file');
		}
	}


}
