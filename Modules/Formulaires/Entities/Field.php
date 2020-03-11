<?php

namespace Modules\Formulaires\Entities;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
    	'name',
    	'formulaire_id',
		'backoffice',
		'label_bo',
		'label_fo',
		'type',
		'actif',
		'placeholder',
		'min',
		'max',
		'step',
		'col',
		'rows',
		'accept',
		'multiple',
		];

		public function formulaire()
		{
			return $this->belongsTo('Modules\Formulaires\Entities\Formulaire');
		}

		public function choices()
		{
			return $this->hasMany('Modules\Formulaires\Entities\Choice','field_id','id');
		}
}