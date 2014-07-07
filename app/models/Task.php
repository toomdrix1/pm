<?php namespace Toomdrix\Pm;

use Eloquent;
use DB;

class Task extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'task';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/task/'.$this->id),
				'Milestone'=> array('text'=>$this->milestone->name, 'link'=>'/milestone/'.$this->milestone->id),
				'Actions'=> array('text'=>\View::make('task.list.actions')->with('id',$this->id))
			);
	}

	public function milestone()
    {
        return $this->belongsTo('Toomdrix\Pm\Milestone');
    }

    public function project()
    {
        return $this->milestone->project();
    }

    public function subtasks()
    {
        return $this->hasMany('Toomdrix\Pm\Task','parent_id');
    }

    public function time()
    {
        return $this->hasMany('Toomdrix\Pm\Time');
    }

}
