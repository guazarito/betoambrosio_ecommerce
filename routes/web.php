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



Route::get('/', ['as'=>'index','uses' => 'HomeController@index']);

Route::get('/info', function () {
    phpinfo();
});


Route::get('/ajuda', ['as'=>'help','uses' => 'admController@help']);

//Route::get('/testemail', ['as'=>'help','uses' => 'admController@testemail']);

 Route::post('comprar', ['as' => 'comprar_post', 'uses' => 'admController@comprar_post'])->middleware('auth');

 Route::get('comprar', ['as' => 'comprar_get', 'uses' => 'admController@comprar_get'])->middleware('auth');

 Route::post('/contato', ['as'=>'contato','uses' => 'admController@contato']);
 
Route::post('/pagseguro/transparente', ['as'=>'pagseguro.transparente.getCode','uses' => 'PagSeguroController@pagseguro_transparente_getCode']);
Route::post('/pagseguro/transparente/cartao-credito', ['as'=>'pagseguro.transparente.cartao-credito','uses' => 'PagSeguroController@pagseguro_transparente_cartaocredito'])->middleware('auth');
Route::post('/pagseguro/transparente/boleto', ['as'=>'pagseguro.transparente.boleto','uses' => 'PagSeguroController@pagseguro_transparente_boleto'])->middleware('auth');

Route::post('/checkout/finalizar_checkout/aAl7yeussXpDGYOYemONtXGDPdcMEc5A1LRwYJ9pFCWMPcH80u', ['as'=>'finalizar_checkout','uses' => 'admController@grava_checkout'])->middleware('auth');

Route::get('/meuspedidos', ['as'=>'meuspedidos','uses' => 'admController@meuspedidos'])->middleware('auth');
Route::get('/meusdados', ['as'=>'meusdados','uses' => 'admController@meusdados'])->middleware('auth');

Route::post('edita_meusdados_inline/{campo}/{id_user}', ['as'=>'adm.edita_meusdados_inline', 'uses' => 'admController@edita_meusdados_inline']);


Route::group(['prefix'=>'adm', 'middleware'=>['auth','authAdm']],function (){
	Route::get('/pedidos', ['as'=>'adm_lista_pedidos','uses' => 'admController@pedidos_index']);
	Route::get('/usuarios', ['as'=>'adm_lista_usuarios','uses' => 'admController@usuarios_index']);
	Route::get('/detalhes_usuario/{id_user}', ['as'=>'adm_detalhes_usuario','uses' => 'admController@detalhes_usuario']);
	//rotas que alteram status envio e salvam o cod rastreio no pedido..
        Route::get('/detalhes_pedido/{id_pedido}', ['as'=>'adm_detalhes_pedido','uses' => 'admController@detalhes_pedido']);
	Route::post('/detalhes_pedido/{id_pedido}', ['as'=>'adm_salva_detalhes_pedido','uses' => 'admController@salva_detalhes_pedido']);
        //fim 
       

});    

 Route::get('adm/rastreio/{cod}', ['as'=>'adm_rastreio','uses' => 'admController@rastrear']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

