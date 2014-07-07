<?php namespace Toomdrix\Pm;

class TaskCreateFormComposer {

	public function compose($view)
	{
		$view->with('milestones', $this->getMilestones($view));
		$view->with('users', $this->getUsers($view));
	}

	private function getMilestones($view) {
		$milestones = new \Illuminate\Database\Eloquent\Collection;

		if ($view->task) {
			$project_id = $view->task->project->id;
		} else {
			$project_id = \Session::get('active_project');
		}

		if ($project_id) {
			$milestones = \DB::table('milestone')->where('project_id','=',$project_id)->orderBy('name', 'asc')->lists('name','id');
		}

		return $milestones;
	}

	private function getUsers($view) {
		return \User::all()->lists('full_name','id');
	}

}
?>
