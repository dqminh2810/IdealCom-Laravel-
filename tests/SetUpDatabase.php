<?php
/**
 * Created by PhpStorm.
 * User: dqminh
 * Date: 23/05/2018
 * Time: 10:23
 */

namespace Tests;


use Illuminate\Support\Facades\Artisan;

trait SetUpDatabase
{
    public function setupDatabase() {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        $this->migrated = true; }
}