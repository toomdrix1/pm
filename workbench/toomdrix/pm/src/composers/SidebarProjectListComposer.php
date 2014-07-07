<?php namespace Toomdrix\Pm;

class SidebarProjectListComposer {

	public function compose($view)
	{
		$data = array(
			(object) array('client'=>'TV VID', 'projects'=>array('one','two')),
			(object) array('client'=>'BRADS', 'projects'=>array('one','two')),
			(object) array('client'=>'NRTH CARV', 'projects'=>array('one','two'))
		);
		$view->with('clients', $data);
	}

}