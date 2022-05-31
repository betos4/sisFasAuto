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
Route::post('users/password', 'UserController@password')->name('users.password');

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

//CLIENTE
Route::get('clientes', 'ClienteController@index')->name('clientes.index');
Route::get('clientes/{cliente}', 'ClienteController@show')->name('clientes.show');
Route::get('clientes/{cliente}/edit', 'ClienteController@edit')->name('clientes.edit');
Route::match(['put', 'patch'], 'clientes/{cliente}', 'ClienteController@update')->name('clientes.update');
Route::delete('clientes/{cliente}', 'ClienteController@destroy')->name('clientes.destroy');

//CREDITO
Route::get('creditos', 'CreditoController@index')->name('creditos.index');
Route::get('creditos/{credito}', 'CreditoController@show')->name('creditos.show');

//ESTADO CIVIL
Route::get('estadoCiviles', 'EstadoCivilController@index')->name('estadoCiviles.index');
Route::get('estadoCiviles/create', 'EstadoCivilController@create')->name('estadoCiviles.create');
Route::post('estadoCiviles', 'EstadoCivilController@store')->name('estadoCiviles.store');
Route::get('estadoCiviles/{estadoCivil}', 'EstadoCivilController@show')->name('estadoCiviles.show');
Route::get('estadoCiviles/{estadoCivil}/edit', 'EstadoCivilController@edit')->name('estadoCiviles.edit');
Route::match(['put', 'patch'], 'estadoCiviles/{estadoCivil}', 'EstadoCivilController@update')->name('estadoCiviles.update');
Route::delete('estadoCiviles/{estadoCivil}', 'EstadoCivilController@destroy')->name('estadoCiviles.destroy');

//TIPO REFERENCIAS
Route::get('tipoReferencias', 'TipoReferenciaController@index')->name('tipoReferencias.index');
Route::get('tipoReferencias/create', 'TipoReferenciaController@create')->name('tipoReferencias.create');
Route::post('tipoReferencias', 'TipoReferenciaController@store')->name('tipoReferencias.store');
Route::get('tipoReferencias/{tipoReferencia}', 'TipoReferenciaController@show')->name('tipoReferencias.show');
Route::get('tipoReferencias/{tipoReferencia}/edit', 'TipoReferenciaController@edit')->name('tipoReferencias.edit');
Route::match(['put', 'patch'], 'tipoReferencias/{tipoReferencia}', 'TipoReferenciaController@update')->name('tipoReferencias.update');
Route::delete('tipoReferencias/{tipoReferencia}', 'TipoReferenciaController@destroy')->name('tipoReferencias.destroy');

//CONTRATOS
Route::get('contratos', 'ContratoController@index')->name('contratos.index');
Route::get('contratos/{credito}/create', 'ContratoController@create')->name('contratos.create');
Route::post('contratos', 'ContratoController@store')->name('contratos.store');
Route::get('contratos/{contrato}', 'ContratoController@show')->name('contratos.show');
Route::get('contratos/{contrato}/edit', 'ContratoController@edit')->name('contratos.edit');
Route::match(['put', 'patch'], 'contratos/{contrato}', 'ContratoController@update')->name('contratos.update');
Route::delete('contratos/{contrato}', 'ContratoController@destroy')->name('contratos.destroy');
Route::get('contratos_buscador', 'ContratoController@findContract')->name('contratos.findContract');
Route::post('contratos/search', 'ContratoController@search')->name('contratos.search');