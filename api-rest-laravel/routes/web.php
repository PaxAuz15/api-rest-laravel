<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/animals', 'TestingController@index');
Route::get('/orm', 'TestingController@testORM');

//API  ROUTES

    //TESTING ROUTES
    Route::get('/user/test', 'UserController@test');
    Route::get('/category/test', 'CategoryController@test');
    Route::get('/post/test', 'PostController@test');

    //USER CONTROLLER ROUTES
    Route::post('/api/register', 'UserController@register');
    Route::post('/api/login','UserController@login');