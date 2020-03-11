<?php

namespace Modules\Countries\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['code', 'name', 'alpha2', 'alpha3'];

	public function domains()
	{
		return $this->hasMany('Modules\Domains\Entities\Domain','country_id','id');
	}

	public function agences()
	{
		return $this->hasMany('Modules\Agences\Entities\Agence','country_id','id');
	}

}
