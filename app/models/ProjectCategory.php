<?php namespace Toomdrix\Pm;

use Eloquent;
use DB;

class ProjectCategory extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_category';

	public function getPrimaryInfo() {
		return array(
				'Name'=> array('text'=>$this->name, 'link'=>'/project_category/'.$this->id),
				'Company'=> array('text'=>$this->company->name, 'link'=>'/company/'.$this->id),
				'Actions'=> array('text'=>\View::make('project_category.list.actions')->with('id',$this->id))
			);
	}

	public function projects()
    {
        return $this->hasMany('Toomdrix\Pm\Project');
    }

}
