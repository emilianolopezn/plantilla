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

//Ruta esta compuestas de 4 cosas
//1.- URL
//2.- Que Controller y que funcion de ese
//    controller responden a esa solicitud
//3.- Nombre de la ruta (opcional)
//4.- Método HTTP

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard','DashboardController@dashboard')
    ->name('dashboard');
Route::get('/perfil','PerfilController@edit')
    ->name('perfil.edit');
Route::put('/perfil/{id}','PerfilController@update')
    ->name('perfil.update');

Auth::routes(['register' => false]);


