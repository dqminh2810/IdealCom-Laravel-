<?php
/**
 * Created by PhpStorm.
 * User: dqminh
 * Date: 15/05/2018
 * Time: 18:22
 */

namespace Tests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplicationWithAuth
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
        Auth::loginUsingId(1);

        return $app;
    }
}