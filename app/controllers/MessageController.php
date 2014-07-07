<?php namespace Toomdrix\Pm;

class MessageController extends \BaseController {

	public function index()
	{

		$list = \View::make('common/list');
		$list->items = Message::paginate(Configuration::find('num_list_items')->value);

		$this->layout->content = $list;

		//$this->layout->sidebar = View::make('block.sidebar.message.categories');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$form = \View::make('message.form');
		$form->project_id = \Session::get('active_project');
		$form->action = array('action' => 'Toomdrix\Pm\MessageController@store', 'class'=>'form-signup');
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
		$message = Message::find($id);
		$this->layout->title = $message->name;

		//$users = \View::make('common/list');
		//$users->items = $message->users()->paginate();

		$view = \View::make('common.tabs');
		$view->tabs = array(
				'Overview' => 'Overview',
				'Tasks' => 'Tasks',
				'Messages' => 'Messages',
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
			$message = new Message;
			$message->name  = \Input::get('name');
			$message->project_id = \Input::get('project_id');
			$message->user_id = \Input::get('user_id');
			$message->save();

			// redirect
			\Flash::push('success', 'Successfully created message!');

			return $this->getRedirect();
		}
	}

	private function validate($update = false) {
		$rules = array(
			'name'  => 'required',
			'project_id'  => 'required',
			'user_id'  => 'required'
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
		$form = \View::make('message.form');
		$form->message = Message::find($id);
		$form->action = array('action' => array('Toomdrix\Pm\MessageController@update', $form->message->id),'class'=>'form-signup');
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
			// store
			$message = Message::find($id);
			$message->name  = \Input::get('name');
			$message->project_id = \Input::get('project_id');
			$message->user_id = \Input::get('user_id');
			$message->save();

			// redirect
			\Flash::push('success', 'Successfully updated message!');
			return $this->getRedirect();
		}
	}


}
