<?php
namespace Modules\Subscribers\Entities;
use \Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    protected $fillable = ['name', 'email', 'actif'];

    public function group_subscriber()
    {
        return $this->hasOne('Modules\Subscribers\Entities\Group_subscribers');
    }
}