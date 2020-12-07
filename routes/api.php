<?php

use Illuminate\Http\Request;

Route::post('/login', 'Api\AuthController@login');
Route::post('/edit_template_setting', ['as' => 'api.edit_template_setting', 'uses' => 'Api\TemplateSettingController@update']);
Route::post('/getPlugByName', ['uses' => 'Api\BackendController@getPlugByName']);
Route::post('/getHtmlTypeBlock', ['uses' => 'Api\BackendController@getHtmlTypeBlock']);


