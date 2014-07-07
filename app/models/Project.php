<?php namespace Toomdrix\Pm;

use Eloquent;
use DB;

class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/project/'.$this->id),
				'Company'=> array('text'=>$this->company->name, 'link'=>'/company/'.$this->id),
				'Category'=> array('text'=>$this->category->name, 'link'=>'/project_category/'.$this->id),
				'Actions'=> array('text'=>\View::make('project.list.actions')->with('id',$this->id))
			);
	}

	public function company()
    {
        return $this->belongsTo('Toomdrix\Pm\Company');
    }

    public function category()
    {
        return $this->belongsTo('Toomdrix\Pm\ProjectCategory','project_category_id');
    }

    public function milestones()
    {
        return $this->hasMany('Toomdrix\Pm\Milestone');
    }

    public function messages()
    {
        return $this->hasMany('Toomdrix\Pm\Message');
    }

    public function files()
    {
        return $this->hasMany('Toomdrix\Pm\File');
    }

    public function tasks()
    {
    	return $this->hasManyThrough('Toomdrix\Pm\Task', 'Toomdrix\Pm\Milestone');
    }

    public function time() {
        $task_ids = $this->tasks()->get(array('task.*'))->lists('id');
        $time = null;
        if ($task_ids) {
            $time = Time::whereIn('task_id', $task_ids)->get();
        }

        return $time;
    }

}
