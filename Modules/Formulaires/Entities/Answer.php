<?php

namespace Modules\Formulaires\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['formulaire_id', 'content', 'ip', 'handled'];

    public function formulaire()
	{
		return $this->belongsTo('Modules\Formulaires\Entities\Formulaire');
	}
}
