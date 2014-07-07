<?php namespace Toomdrix\Pm;

class DoorstepController extends \BaseController {

	protected $layout = 'template';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$this->layout->title = "Login";
		$this->layout->content = \View::make('doorstep.login');
	}

	public function postLogin()
	{
		if (\Auth::attempt(array('email'=>\Input::get('email'), 'password'=>\Input::get('password')))) {
			\Flash::push('success', 'You are now logged in!');
			return \Redirect::to('dashboard');
		} else {
			\Flash::push('warning', 'Your username/password combination was incorrect');
			return \Redirect::to('doorstep')
			->withInput();
		}
	}

	public function getCreate() {
		$user = new \User;
		$user->firstname = 'Adrian';
		$user->lastname = 'Toomer';
		$user->email = 'adrian@fluidcreativity.co.uk';
		$user->company_id = 1;
		$user->password = \Hash::make('testing');
		$user->save();
	}

}
