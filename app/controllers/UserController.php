<?php namespace Toomdrix\Pm;

class UserController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = \User::paginate(Configuration::find('num_list_items')->value);

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
		$form = \View::make('user.form');
		$form->action = array('action' => 'Toomdrix\Pm\UserController@store', 'class'=>'form-signup');
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
		$user = \User::find($id);
		$this->layout->title = $user->firstname . ' ' .$user->lastname;

		//$users = \View::make('common/list');
		//$users->items = $user->users()->paginate();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'Overview' => 'Overview',
				'Tasks' => 'Tasks',
				'Projects' => 'Projects',
				'Milestones' => 'Milestones',
				'Schedule' => 'Schedule',
				'Permissions' => 'Permissions',
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
			return \Redirect::to('user')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$user = new \User;
			$user->firstname  = \Input::get('firstname');
			$user->lastname   = \Input::get('lastname');
			$user->company_id = \Input::get('company_id');
			$user->email      = \Input::get('email');
			$user->password   = \Hash::make(\Input::get('password'));
			$user->save();

			// redirect
			\Flash::push('success', 'Successfully created user!');

			return \Redirect::to('user');
		}
	}

	private function validate($update = false) {
		$rules = array(
			'firstname'  => 'required',
			'lastname'   => 'required',
			'email'      => 'required|email'.(!$update ? '|unique:users':'' ),
			'password'   => 'required'
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
		$form = \View::make('user.form');
		$form->user = \User::find($id);
		$form->action = array('action' => array('Toomdrix\Pm\UserController@update', $form->user->id),'class'=>'form-signup');
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
			return \Redirect::to('user')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$user = \User::find($id);
			$user->firstname  = \Input::get('firstname');
			$user->lastname   = \Input::get('lastname');
			$user->email      = \Input::get('email');
			$user->company_id = \Input::get('company_id');
			$user->password   = \Hash::make(\Input::get('password'));
			$user->save();

			// redirect
			\Flash::push('success', 'Successfully updated user!');
			return \Redirect::to('user');
		}
	}

}
