<?php namespace Toomdrix\Pm;

use Eloquent;
use DB;

class Time extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'time';

	public function getPrimaryInfo() {
		return array(
				'Description'=> array('text'=>$this->description, 'link'=>'/time/'.$this->id),
				'User'=> array('text'=>$this->user->firstname.' '.$this->user->lastname, 'link'=>'/user/'.$this->user->id),
				'Task'=> array('text'=>$this->task->name, 'link'=>'/task/'.$this->task->id),
				'Actions'=> array('text'=>\View::make('time.list.actions')->with('id',$this->id))
			);
	}

	public function task()
    {
        return $this->belongsTo('Toomdrix\Pm\Task');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}
