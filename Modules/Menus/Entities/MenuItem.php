<?php

namespace Modules\Menus\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
    	'name',
    	'display_name',
		'menu_id',
    	'left',
    	'right',
		'parent_id',
		'arbre_id',
    	'hidden',
		'readonly',
		'target',
		'actif',
	];

    public function scopeSameArbre($query)
	{
		return $query
			->where('menu_id', $this->menu_id)
			//->where('arbre_id', $this->arbre_id)
			->get();
	}

    public function scopeHierarchies($query)
	{
    	return $query
			->where('menu_id', $this->menu_id)
			->where('arbre_id', $this->arbre_id)
			->where('right', '>', $this->right)
			->get();
	}

	public function menu()
	{
		return $this->belongsTo('Modules\Menus\Entities\Menu');
	}

}
