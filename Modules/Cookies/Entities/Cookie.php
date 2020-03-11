<?php

namespace Modules\Cookies\Entities;

use Illuminate\Database\Eloquent\Model;

class Cookie extends Model
{
    protected $fillable = [
    	'title',
			'position',
			'banner_color',
			'banner_text',
			'banner_text_color',
			'button_color',
			'button_text',
			'button_text_color',
			'link',
			'actif'
		];
}
