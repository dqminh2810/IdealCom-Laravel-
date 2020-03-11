<?php

namespace Modules\News\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Translatable;
    protected $fillable = ['image', 'user_id', 'actif', 'created_at', 'updated_at'];

    public $translatedAttributes = ['title', 'resume', 'content'];

    // Ajout appartenance à un utilisateur
		// https://openclassrooms.com/courses/decouvrez-le-framework-php-laravel-1/la-relation-1-n-1#/id/r-3618151
    public function user()
		{
			return $this->belongsTo('App\User');
		}

    public function newstranslation(){
        return $this->hasMany('Modules\News\Entities\NewsTranslation');
    }
}

