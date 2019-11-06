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

use Illuminate\Routing\RouteGroup;

Route::get('/', function () {return view('welcome'); });

Route::get('/login', 'DashboardController@login')->name('login');
Route::get('/logout', 'DashboardController@logout')->name('logout');
Route::get('/register', 'DashboardController@register')->name('register');
Route::post('/auth', 'DashboardController@auth')->name('auth');

Route::post('/user', 'UsersController@store')->name('user.store');

Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::resource('servico', 'ServicosController');
});



