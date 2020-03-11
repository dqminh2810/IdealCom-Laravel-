<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
		'email',
		'password',
		'admin',
		'telephone',
		'website',
		'address',
		'city',
		'country',
		'actif',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	// Ajout appartenance à des articles
	// https://openclassrooms.com/courses/decouvrez-le-framework-php-laravel-1/la-relation-1-n-1#/id/r-3618151
	public function news()
    {
        return $this->hasMany('\Modules\News\Entities\News');
    }
    public function medias()
    {
        return $this->hasMany('\Modules\Medias\Entities\Media');
    }
}
