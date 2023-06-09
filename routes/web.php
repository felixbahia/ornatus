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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/adicionar', 'PedidoController@adicionarCarrinho')->name('carrinho.adicionar');
Route::get('/visualizar', 'PedidoController@visualizarCarrinho')->name('carrinho.visualizar');
Route::post('/excluir', 'PedidoController@excluirCarrinho')->name('carrinho.excluir');
Route::post('/gerar', 'PedidoController@gerarPedido')->name('gerar.pedido');
Route::get('/pedido', 'PedidoController@visualizarPedido')->name('visualizar.pedido');
