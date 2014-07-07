<?php namespace Toomdrix\Pm;

class UsergroupController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Usergroup::paginate(Configuration::find('num_list_items')->value);

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
		$form = \View::make('usergroup.form');
		$form->action = array('action' => 'Toomdrix\PmUsergroupController@store', 'class'=>'form-signup');
		return $form;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!$this->validate()) {
			return \Redirect::to('usergroup')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$usergroup = new Usergroup;
			$usergroup->firstname  = \Input::get('firstname');
			$usergroup->lastname   = \Input::get('lastname');
			$usergroup->company_id = \Input::get('company_id');
			$usergroup->email      = \Input::get('email');
			$usergroup->password   = \Hash::make(\Input::get('password'));
			$usergroup->save();

			// redirect
			\Flash::push('success', 'Successfully created usergroup!');

			return \Redirect::to('usergroup');
		}
	}

	private function validate($update = false) {
		$rules = array(
			'firstname'  => 'required',
			'lastname'   => 'required',
			'email'      => 'required|email'.(!$update ? '|unique:usergroups':'' ),
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
		$form = \View::make('usergroup.form');
		$form->usergroup = Usergroup::find($id);
		$form->action = array('action' => array('Toomdrix\PmUsergroupController@update', $form->usergroup->id),'class'=>'form-signup');
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
			return \Redirect::to('usergroup')
			->withErrors($this->validator)
			->withInput(\Input::except('password'));
		} else {
			// store
			$usergroup = Usergroup::find($id);
			$usergroup->firstname  = \Input::get('firstname');
			$usergroup->lastname   = \Input::get('lastname');
			$usergroup->email      = \Input::get('email');
			$usergroup->company_id = \Input::get('company_id');
			$usergroup->password   = \Hash::make(\Input::get('password'));
			$usergroup->save();

			// redirect
			\Flash::push('success', 'Successfully updated usergroup!');
			return \Redirect::to('usergroup');
		}
	}

}
