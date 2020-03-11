<?php
namespace Modules\Subscribers\Entities;
use \Illuminate\Database\Eloquent\Model;

class Group_subscribers extends Model
{
    protected $fillable = ['subscriber_id', 'group_id'];

    public function subscriber()
    {
        return $this->belongsTo('Modules\Subscribers\Entities\Subscribers');
    }

    public function group()
    {
        return $this->belongsTo('Modules\Subscribers\Entities\Groups');
    }

}