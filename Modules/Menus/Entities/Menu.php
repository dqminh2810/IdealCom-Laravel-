<?php

namespace Modules\Menus\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
    	'name',
		'display_name',
		'home',
		'position',
		'actif',
	];

	public function menuitems()
	{
		return $this->hasMany('Modules\Menus\Entities\MenuItem');
	}
}
