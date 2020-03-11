<?php

Route::group(['middleware' => 'web', 'prefix' => 'medias', 'namespace' => 'Modules\Medias\Http\Controllers'], function()
{
    Route::get('/', 'MediasController@index');
});
