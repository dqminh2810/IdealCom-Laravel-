<?php

namespace Modules\Formulaires\Entities;

use Illuminate\Database\Eloquent\Model;

class Formulaire extends Model
{
    protected $fillable = [
    	'uuid',
			'title',
			'name_from',
			'email_from',
			'email_to',
			'email_to_cc',
		];

	public function fields ()
	{
		return $this->hasMany('Modules\Formulaires\Entities\Field','formulaire_id','id');
	}

	public function answers ()
	{
		return $this->hasMany('Modules\Formulaires\Entities\Answer','formulaire_id','id');
	}
}
