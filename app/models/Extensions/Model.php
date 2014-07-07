<?php namespace Toomdrix\Pm;

use Illuminate\Database\Eloquent\Model as CoreModel;

abstract class Model extends CoreModel {

	/**
	 * Create a new Eloquent query builder for the model.
	 *
	 * @param  \Illuminate\Database\Query\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function newEloquentBuilder($query)
	{
		return new Builder($query);
	}

}
