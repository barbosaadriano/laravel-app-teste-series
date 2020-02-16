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


Route::group(['prefix' => 'series'], function () {
    Route::get('', 'SeriesController@index')->name('listar_series');
    Route::get('{serieId}/temporadas', 'TemporadasController@index');
    Route::group(['middleware' => ['autenticador']], function () {
        Route::get('criar', 'SeriesController@create')->name('form_criar_serie');
        Route::post('criar', 'SeriesController@store');
        Route::delete('{id}', 'SeriesController@destroy');
        Route::post('{id}/editaNome', 'SeriesController@editaNome');
    });
});
Route::group(['prefix' => 'temporadas'], function () {
    Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
    Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
        ->middleware('autenticador');
});
Route::group(['middleware' => ['autenticador']], function () {
    Route::get('/apontamento/create', 'ApontamentoController@create')->name('criar_apontamento');
    Route::post('/apontamento/create', 'ApontamentoController@store')->name('salvar_apontamento');
    Route::get('/apontamento','ApontamentoController@index')->name('apontamentos');

    Route::group(['prefix' => 'users'], function () {
        Route::get('','UsersController@index')->name('listar_usuarios');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});
