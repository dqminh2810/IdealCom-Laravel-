<?php

Route::group(['middleware' => 'web', 'prefix' => 'formulaires', 'namespace' => 'Modules\Formulaires\Http\Controllers'], function()
{
    Route::get('/', 'FormulairesController@index');
});
