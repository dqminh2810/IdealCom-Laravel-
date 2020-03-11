<?php

Route::group(['middleware' => 'web', 'prefix' => 'subscribers', 'namespace' => 'Modules\Subscribers\Http\Controllers'], function()
{
    Route::get('/', 'SubscribersController@index');
});
