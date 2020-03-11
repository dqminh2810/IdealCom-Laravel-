<?php

Route::group(['middleware' => 'web', 'prefix' => 'domains', 'namespace' => 'Modules\Domains\Http\Controllers'], function()
{
    Route::get('/', 'DomainsController@index');
});
