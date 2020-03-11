<?php

Route::group(['middleware' => 'web', 'prefix' => 'languages', 'namespace' => 'Modules\Languages\Http\Controllers'], function()
{
    Route::get('/', 'LanguagesController@index');
});
