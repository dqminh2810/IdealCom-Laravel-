<?php

Route::group(['middleware' => 'web', 'prefix' => 'agences', 'namespace' => 'Modules\Agences\Http\Controllers'], function()
{
    Route::get('/', 'AgencesController@index');
});
