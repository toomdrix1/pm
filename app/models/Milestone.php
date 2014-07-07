<?php namespace Toomdrix\Pm;

use Eloquent;
use DB;

class Milestone extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'milestone';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/milestone/'.$this->id),
				'Project'=> array('text'=>$this->project->name, 'link'=>'/project/'.$this->project->id),
				'Actions'=> array('text'=>\View::make('milestone.list.actions')->with('id',$this->id))
			);
	}

	public function project()
    {
        return $this->belongsTo('Toomdrix\Pm\Project');
    }

    public function tasks()
    {
        return $this->hasMany('Toomdrix\Pm\Task');
    }

}
