<?php
namespace Modules\Subscribers\Entities;
use \Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['name', 'email', 'actif'];

    public function groups(){
        return $this->belongsToMany('Modules\Subscribers\Entities\Group');
    }
}