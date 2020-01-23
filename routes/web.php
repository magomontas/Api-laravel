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

Route::post('/api/register', 'UserController@register');
Route::post('/api/login', 'UserController@login');
Route::post('/api/test', 'UserController@index');
Route::get('/api/showAll', 'UserController@showAll');

Route::resource('/api/materias', 'MateriaController');
Route::resource('/api/user', 'UserController');
Route::resource('/api/user.materias', 'UserMateriaController');
