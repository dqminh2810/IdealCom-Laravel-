<?php

Route::group(['middleware' => 'web', 'prefix' => 'countries', 'namespace' => 'Modules\Countries\Http\Controllers'], function()
{
    Route::get('/', 'CountriesController@index');
});
