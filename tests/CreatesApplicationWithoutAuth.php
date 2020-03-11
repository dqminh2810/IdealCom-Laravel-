<?php
/**
 * Created by PhpStorm.
 * User: dqminh
 * Date: 15/05/2018
 * Time: 18:20
 */

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplicationWithoutAuth
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        Hash::driver('bcrypt')->setRounds(4);
        return $app;
    }
}