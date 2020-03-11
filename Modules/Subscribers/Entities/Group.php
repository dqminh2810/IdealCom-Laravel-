<?php
namespace Modules\Subscribers\Entities;
use \Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    protected $fillable = ['code', 'actif'];

    public function subscribers(){
        return $this->belongsToMany('Modules\Subscribers\Entities\Subscriber');
    }
}