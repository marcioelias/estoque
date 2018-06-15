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

Auth::routes();

Route::middleware(['auth:web'])->group(function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/perfil', 'UserController@profile')->name('user.profile');
    Route::get('/alterar_senha', 'UserController@showChangePassword')->name('user.form.change.password');
    Route::put('/alterar_senha/{user}', 'UserController@changePassword')->name('user.change.password');

    Route::resource('/user', 'UserController')->except('show');
    Route::resource('/grupo_produto', 'GrupoProdutoController');
    Route::resource('/unidade', 'UnidadeController')->except('show');
    Route::resource('/produto', 'ProdutoController')->except('show');
    Route::resource('/cliente', 'ClienteController')->except('show');
    Route::resource('/fornecedor', 'FornecedorController')->except('show');
    Route::resource('/estoque', 'EstoqueController')->except('show');
    Route::resource('/parametro', 'ParametroController')->except('show');
    Route::resource('/tipo_movimentacao_produto', 'TipoMovimentacaoProdutoController')->except('show');
    Route::resource('/entrada_estoque', 'EntradaEstoqueController')->except('show');
    Route::resource('/inventario', 'InventarioController');

    Route::resource('/role_user', 'RoleUsersController')->except('show');
    Route::resource('/role', 'RolesController')->except('show');

    /* Route::get('/parametro', 'ParametroController@index')->name('parametro.index');
    Route::post('/parametro', 'ParametroController@store')->name('parametro.store');
    Route::put('/parametro/{parametro}', 'ParametroController@update')->name('parametro.update'); */


    //relatorios
    Route::get('relatorios/listagem_clientes', 'ClienteController@listagemClientes')->name('relatorio_listagem_clientes');
    Route::get('relatorios/posicao_estoque', 'MovimentacaoProdutoController@paramRelatorioPosicaoEstoque')->name('param_relatorio_posicao_estoque');
    Route::post('relatorios/posicao_estoque', 'MovimentacaoProdutoController@relatorioPosicaoEstoque')->name('relatorio_posicao_estoque');
});
