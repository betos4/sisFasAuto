<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('/', 'LoginController@index')->name('login');
Route::post('/', 'LoginController@validateLogin')->name('validateLogin');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('home', 'HomeController@index')->name('dashboard');

//USUARIOS
//Route::resource('users', UserController::class);
Route::get('users', 'UserController@index')->name('users.index');
Route::get('users/create', 'UserController@create')->name('users.create');
Route::post('users', 'UserController@store')->name('users.store');
Route::get('users/{user}', 'UserController@show')->name('users.show');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::match(['put', 'patch'], 'users/{user}', 'UserController@update')->name('users.update');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
Route::get('users/{user}/password', 'UserController@password')->name('users.password');

//MENU
Route::resource('menus','MenuController');
Route::post('menus/save-order', 'MenuController@saveOrder')->name('save_order');

//ROLES
Route::get('roles', 'RolController@index')->name('roles.index');
Route::get('roles/create', 'RolController@create')->name('roles.create');
Route::post('roles', 'RolController@store')->name('roles.store');
Route::get('roles/{rol}', 'RolController@show')->name('roles.show');
Route::get('roles/{rol}/edit', 'RolController@edit')->name('roles.edit');
Route::match(['put', 'patch'], 'roles/{rol}', 'RolController@update')->name('roles.update');
Route::delete('roles/{rol}', 'RolController@destroy')->name('roles.destroy');

//MENU-ROL
Route::get('menu-rol', 'MenuRolController@index')->name('menu_rol');
Route::post('menu-rol', 'MenuRolController@store')->name('guardar_menu_rol');