<?php

namespace Modules\Languages\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
    	'code',
		'name',
		'native_name',
		'actif',
	];
}
