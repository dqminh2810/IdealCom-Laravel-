<?php

namespace Modules\Domains\Entities;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
    	'code',
		'name',
		'display_name',
		'extension',
		'country_id',
		'google_analytics',
		'google_webmastertool',
		'google_maps',
		'actif',
	];

    public function country()
	{
		return $this->belongsTo('Modules\Countries\Entities\Country');
	}

	public function agences()
	{
		return $this->belongsToMany('Modules\Agences\Entities\Agence');
	}
}