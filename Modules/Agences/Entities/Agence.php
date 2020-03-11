<?php

namespace Modules\Agences\Entities;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    protected $fillable = [
		'name',
		'web_agence',
		'address',
		'complement',
		'zip_code',
		'city',
		'country_id',
		'website',
		'email',
		'actif',
	];

	public function country()
	{
		return $this->belongsTo('Modules\Countries\Entities\Country');
	}

	public function domains()
	{
		return $this->belongsToMany('Modules\Domains\Entities\Domain');
	}
}
