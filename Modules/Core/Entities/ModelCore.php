<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class ModelCore extends Model
{
    protected $fillable = [];

	/**
	 * @return bool
	 */
	public function disable()
		{
			$this->actif = 0;
			return $this->save();
		}

	/**
	 * @return bool
	 */
	public function enable()
		{
			$this->actif = 1;
			return $this->save();
		}
}
