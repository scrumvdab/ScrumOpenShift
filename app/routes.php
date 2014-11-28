<?php

$html = 'test';
$string = 'testtest';
$pdf = 'test';

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('home', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('activiteiten', [
    'as' => 'activiteiten',
    'uses' => 'ActiviteitenController@main'
]);

Route::get('contact', [
    'as' => 'contact',
    'uses' => 'ContactController@main'
]);

Route::get('leden', [
    'as' => 'leden',
    'uses' => 'LedenController@main'
]);

Route::get('vrijwilligers', [
    'as' => 'vrijwilligers',
    'uses' => 'VrijwilligersController@main'
]);

Route::get('giften', [
    'as' => 'giften',
    'uses' => 'GiftenController@main'
]);

Route::get('links', [
    'as' => 'links',
    'uses' => 'LinksController@main'
]);

//authentication
Route::controller('user', 'UserController');

// active link
HTML::macro('clever_link', function($route, $text) {
    if (Request::path() == $route) {
        $active = "class = 'active'";
    } else {
        $active = '';
    }

    return '<li ' . $active . '>' . link_to($route, $text) . '</li>';
});

Route::get('PDF', function() {
    $pdf = View::make('PDF');
    $pdf->render();
    return PDF::load($pdf, 'A4', 'portrait')->show();
});

//avatar 
Route::get('upload', function() {
    return View::make('user.dashboard');
});
Route::post('apply/upload', 'ApplyController@upload');

Route::group(array('prefix' => '/forum'), function() {
    Route::get('/', array('uses' => 'ForumController@index', 'as' => 'forum-home'));
    Route::get('/category/{id}', array('uses' => 'ForumController@category', 'as' => 'forum-category'));
    Route::get('/thread/{id}', array('uses' => 'ForumController@thread', 'as' => 'forum-thread'));

    Route::group(array('before' => 'admin'), function() {
        Route::get('/group/{id}/delete', array('uses' => 'ForumController@deleteGroup', 'as' => 'forum-delete-group'));
        Route::get('/category/{id}/delete', array('uses' => 'ForumController@deleteCategory', 'as' => 'forum-delete-category'));
        Route::get('/thread/{id}/delete', array('uses' => 'ForumController@deleteThread', 'as' => 'forum-delete-thread'));
        Route::get('/comment/{id}/delete', array('uses' => 'ForumController@deleteComment', 'as' => 'forum-delete-comment'));

        Route::group(array('before' => 'csrf'), function() {
            Route::post('/category/{id}/new', array('uses' => 'ForumController@storeCategory', 'as' => 'forum-store-category'));
            Route::post('/group', array('uses' => 'ForumController@storeGroup', 'as' => 'forum-store-group'));
        });
    });

    Route::group(array('before' => 'auth'), function() {
        Route::get('/thread/{id}/new', array('uses' => 'ForumController@newThread', 'as' => 'forum-get-new-thread'));

        Route::group(array('before' => 'csrf'), function() {
            Route::post('/thread/{id}/new', array('uses' => 'ForumController@storeThread', 'as' => 'forum-store-thread'));
            Route::post('/comment/{id}/new', array('uses' => 'ForumController@storeComment', 'as' => 'forum-store-comment'));
        });
    });
});

Route::group(array('before' => 'guest'), function() {
    Route::get('/users/create', array('uses' => 'UserController@getCreate', 'as' => 'getCreate'));
    Route::get('/users/login', array('uses' => 'UserController@getLogin', 'as' => 'getLogin'));

    Route::group(array('before' => 'csrf'), function() {
        Route::post('/users/create', array('uses' => 'UserController@postCreate', 'as' => 'postCreate'));
        Route::post('/users/login', array('uses' => 'UserController@postLogin', 'as' => 'postLogin'));
    });
});

Route::group(array('before' => 'auth'), function() {
    Route::get('/users/logout', array('uses' => 'UserController@getLogout', 'as' => 'getLogout'));
    Route::put('users/update', array('uses' => 'UserController@putUpdate', 'as' => 'putUpdate'));
});

Route::get('add', 'ActiviteitenController@add');

Route::get('add_activity', 'ActiviteitenController@add_activity');
