<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

// Route::resource('databags', 'DatabagsController');
Route::group(['prefix' => 'databags', /*'before' => 'auth'*/], function () {
        Route::get('/', [
        'as'   => 'databags.index',
        'uses' => 'DatabagsController@index',
    ]);

    Route::get('/create/{item?}', [
        'as'   => 'databags.create',
        'uses' => 'DatabagsController@create',
    ]);

    Route::post('/', [
        'as'   => 'databags.store',
        'uses' => 'DatabagsController@store',
    ]);

    Route::get('/{databags}', [
        'as'   => 'databags.show',
        'uses' => 'DatabagsController@show',
    ]);

    Route::get('/{databags}/item/{item}', [
        'as'   => 'databags.editItem',
        'uses' => 'DatabagsController@editItem',
    ]);
    Route::get('/delete/{id}', [
        'as'   => 'databags.destroy',
        'uses' => 'DatabagsController@delete',
    ]);
});
