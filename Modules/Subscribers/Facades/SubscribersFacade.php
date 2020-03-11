<?php
namespace Modules\Subscribers\Facades;

use Modules\Subscribers\Entities\Group_subscriber;
use Modules\Subscribers\Entities\Group;

class SubscribersFacade
{

    public static function getArrayGroupsName(){
        $groups = Group::where('actif', 1)->get();
        $result=array();
        foreach ($groups as $key=>$group)
        {
            $result[$key] =$group->group_name;
        }

        return $result;
    }
}