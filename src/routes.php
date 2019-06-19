<?php

Route::group(['namespace' => 'Avl\AdminManuals\Controllers\Admin', 'middleware' => ['web', 'admin'], 'as' => 'adminmanuals::'], function () {

		Route::post('/manuals/{id}/getManuals', 'ManualsController@getManuals');
		Route::resource('/manuals/{id}/lists', 'ManualsController');

		Route::post('/manuals/{id}/lists/{alias}/getManualsData', 'ManualsDataController@getManualsData');
		Route::resource('/manuals/{id}/lists/{alias}/data', 'ManualsDataController');

		Route::post('/manuals-menu/getManuals', 'ManualsMenuController@getManuals');
		Route::resource('/manuals-menu', 'ManualsMenuController')->only([ 'index', 'update', 'destroy' ]);
});
