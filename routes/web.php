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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Estados */
Route::resource('estados', 'EstadosController');
Route::get('estado/{id}', 'EstadosController@desativar');

/* Cidades */
Route::resource('cidades', 'CidadesController');
Route::get('cidade/{id}', 'CidadesController@desativar');

/* Telefones */
Route::resource('telefones', 'TelefonesController');
Route::get('telefone/{id}', 'TelefonesController@desativar');

/* Emails */
Route::resource('emails', 'EmailsController');
Route::get('email/{id}', 'EmailsController@desativar');

/* Endereços */
Route::resource('enderecos', 'EnderecosController');
Route::get('endereco/{id}', 'EnderecosController@desativar');

/* Usuários */
Route::resource('usuarios', 'UsuariosController');
Route::get('usuarios/{id}/delete', ['uses' => 'UsuariosController@destroy', 'as' => 'usuarios.delete']);
