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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('logout', 'Auth\LoginController@logout');
Route::post('login', 'Auth\LoginController@index')->name('login');

Route::get('/novo-morador', 'NovoMoradorController@index');
Route::post('/novo-morador', 'NovoMoradorController@add');

Route::get('/moradores', 'MoradoresController@index');
Route::post('/moradores', 'MoradoresController@deleteUser');

Route::get('/ocorrencias', 'OcorrenciasController@index');
Route::post('/detalhe-ocorrencia', 'OcorrenciasController@detalhes');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
