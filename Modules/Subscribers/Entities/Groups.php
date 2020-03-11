<?php
namespace Modules\Subscribers\Entities;
use \Illuminate\Database\Eloquent\Model;


class Groups extends Model
{
    protected $fillable = ['code', 'actif'];

    public function group_subscriber()
    {
        return $this->hasMany('Modules\Subscribers\Entities\Group_subscribers');
    }
}