<?php namespace Toomdrix\Pm;

use Eloquent;
use DB;

class File extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'file';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/file/'.$this->id),
				'Project'=> array('text'=>$this->project->name, 'link'=>'/project/'.$this->project->id),
				'Actions'=> array('text'=>\View::make('file.list.actions')->with('id',$this->id))
			);
	}

	public function project()
    {
        return $this->belongsTo('Toomdrix\Pm\Project');
    }

}
