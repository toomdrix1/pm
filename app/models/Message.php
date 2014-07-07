<?php namespace Toomdrix\Pm;

use Eloquent;
use DB;

class Message extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'message';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/message/'.$this->id),
				'Task'=> array('text'=>$this->task->name, 'link'=>'/task/'.$this->task->id),
				'Actions'=> array('text'=>\View::make('message.list.actions')->with('id',$this->id))
			);
	}

	public function company()
    {
        return $this->belongsTo('Toomdrix\Pm\Task');
    }

}
