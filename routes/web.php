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
Route::group(['middleware' => ['autenticador']], function () {
    Route::group(['middleware'=>['sel.emp']],function(){
        Route::get('/apontamento/create', 'ApontamentoController@create')->name('criar_apontamento');
        Route::post('/apontamento/create', 'ApontamentoController@store')->name('salvar_apontamento');
        Route::get('/apontamento','ApontamentoController@index')->name('apontamentos');
        Route::get('/apontamento/exportar/{usuario}/{tipo}','ApontamentoController@exportar')->name('exportar_apontamentos');

        Route::group(['prefix' => 'users'], function () {
            Route::get('','UsersController@index')->name('listar_usuarios');
            Route::get('envite','EnviteUserController@index')->name('convidar_usuario');
            Route::post('envite','EnviteUserController@store')->name('enviar_convite');
        });
        Route::get('','HomeController@index')->name('home');
    });
    Route::get('empresas/selecionar','EmpresaController@listarParaSelecao')->name('listar_empresas');
    Route::get('empresas/selecionar/{empresa}','EmpresaController@selecionar')->name('selecionar_empresa');
});

Auth::routes();

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');
Route::get('/aceitar','EnviteUserController@aceitar')->name('aceitar');
Route::post('/aceitar','RegistroController@store');

Route::get('/sair', function () {
    session()->forget('empresa');
    Auth::logout();
    return redirect('/entrar');
});
