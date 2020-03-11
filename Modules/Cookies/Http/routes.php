<?php

Route::group(['middleware' => 'web', 'prefix' => 'cookies', 'namespace' => 'Modules\Cookies\Http\Controllers'], function()
{
    Route::get('/', 'CookiesController@index');
});
