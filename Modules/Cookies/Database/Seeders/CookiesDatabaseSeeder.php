<?php

namespace Modules\Cookies\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cookies\Entities\Cookie;

class CookiesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$cookie = new Cookie();

			$cookie->title = 'Default';
			$cookie->position = 'bottom';
			$cookie->banner_color = '#edeff5';
			$cookie->banner_text = 'Nous utilisons des cookies pour optimiser votre expérience sur notre site.';
			$cookie->banner_text_color = '#8383a8';
			$cookie->button_color = '#4b81e8';
			$cookie->button_text = 'Accepter';
			$cookie->button_text_color = '#ffffff';
			$cookie->link = 'https://cookiesandyou.com/';
			$cookie->actif = '1';


			$cookie->save();
    }
}
