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

    Route::get('/destroy/{id}', [
        'as'   => 'databags.destroy',
        'uses' => 'DatabagsController@destroy',
    ]);

    Route::get('/destroyItem/{databags}/{id}', [
        'as'   => 'databags.destroyItem',
        'uses' => 'DatabagsController@destroyItem',
    ]);
});

Route::group(['prefix' => 'nodes', /*'before' => 'auth'*/], function () {
    Route::get('/', [
        'as'   => 'nodes.index',
        'uses' => 'NodesController@index',
    ]);

    Route::get('/create', [
        'as'   => 'nodes.create',
        'uses' => 'NodesController@create',
    ]);

    Route::get('/{node}', [
        'as'   => 'nodes.show',
        'uses' => 'NodesController@show',
    ]);

    Route::get('/destroy/{id}', [
        'as'   => 'nodes.destroy',
        'uses' => 'NodesController@destroy',
    ]);

    Route::get('/{node}/edit', [
        'as'   => 'nodes.edit',
        'uses' => 'NodesController@edit',
    ]);

    Route::post('/edit', [
        'as'   => 'nodes.store',
        'uses' => 'NodesController@store',
    ]);

    Route::post('/', [
        'as'   => 'nodes.storeCreate',
        'uses' => 'NodesController@storeCreate',
    ]);
});

Route::group(['prefix' => 'cookbooks', /*'before' => 'auth'*/], function () {
    Route::get('/', [
        'as'   => 'cookbooks.index',
        'uses' => 'CookbooksController@index',
    ]);
});
