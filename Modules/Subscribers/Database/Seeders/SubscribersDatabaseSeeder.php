<?php

namespace Modules\Subscribers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Subscribers\Entities\Subscriber;
use Modules\Subscribers\Entities\Group;
use Modules\Subscribers\Entities\Group_subscriber;

class SubscribersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 10; ++$i)
        {
            $subscriber = new Subscriber();
            $subscriber->subscriber_name = "Name ".$i;
            $subscriber->email = "Email".$i."@blop.fr";
            $subscriber->actif= rand(0,1);
            $subscriber->save();
        }

        $group1 = new Group();
        $group1->code = "GROUPE 1";
        $group1->group_name = "Groupe 1";
        $group1->actif = rand(0,1);
        $group1->save();
        $group2 = new Group();
        $group2->code = "GROUPE 2";
        $group2->group_name = "Groupe 2";
        $group2->actif = rand(0,1);
        $group2->save();

        for($i = 1; $i < 10; ++$i){
            DB::table('group_subscriber')->insert([
                ['subscriber_id' => $i, 'group_id' => 1 ]
            ]);
        }
    }
}
