<?php

namespace Modules\Formulaires\Entities;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
    	'field_id',
    	'label',
		'value',
		'selected',
		'actif'
		];

	public function field()
	{
		return $this->belongsTo('Modules\Formulaires\Entities\Field');
	}
}
