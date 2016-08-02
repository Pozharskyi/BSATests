<?php


Route::group(['prefix' => 'api/v1', 'middleware' => 'throttle:30'], function () {        //v1 - the version of the API, throttle:4 - rate limiting 30 request per minute
    Route::resource('books', 'BooksController', ['except' => [
         'edit', 'create'
    ]]);
    Route::resource('users', 'UsersController', ['only' => [
        'show', 'index']
    ]);
    Route::resource('users.books', 'UsersBooksController', ['only' => [
        'index', 'destroy', 'update', 'show']
    ]);
});
Route::get('/', function () {
    return view('base');
});