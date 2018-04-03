<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use Auth;
use App\Notifications\lojaNotify;
use App\Notifications\postedNotify;
use Mail;


class admController extends Controller {
	
	public function testemail(){
		 $user = new User;
         $user = $user->where('id', 6)->first();
		 
		 $user->notify(new lojaNotify($user));
		 

		 
		 echo $user->email;
	}

    public function comprar_post(Request $request, Order $order) {

        $ref_num = $order->max('id');
        $ref_num++;
     

        $dados_compra['valorLivro'] = $request->frm_valorLivro;
        $dados_compra['valorFrete'] = $request->frm_valorFrete;
        $dados_compra['qtde'] = $request->frm_qtde;
        $dados_compra['taxaPagSeguro'] = $request->frm_valorTaxa;
        $dados_compra['valorTotal'] = $request->frm_valorTotal;
        $dados_compra['ref_num'] = $ref_num;

		if ($request->session()->has('dados_compra')) {
			$request->session()->forget('dados_compra');
		}


        return view('pagseguro', compact('dados_compra'));
    }

    public function comprar_get(Request $request) {


        if ($request->session()->has('dados_compra')) {
            $dados_compra = $request->session()->get('dados_compra');
            return view('pagseguro', compact('dados_compra'));
        } else {
            return redirect()->route('index');
        }
    }

    public function grava_checkout(Request $request, Order $order) {

        //  dd($request);

        $order->user_id = Auth::user()->id;
        $order->reference = $request->ref_num;
        //$order->rastreio = ;
        $order->pagseguro_transaction_code = $request->transactionCode;
        $order->qtde = $request->qtde;
        $order->frete = $request->valorFrete;
        $order->preco_livro = number_format($request->valorTotal - $request->valorFrete - $request->taxaPagSeguro, 2);
        $order->taxa_pagseguro = $request->taxaPagSeguro;
        $order->preco_total = $request->valorTotal;
        $order->status = 1;
        if (isset($request->url_boleto)) {
            $order->forma_pagto = "boleto";
            $order->url_boleto = $request->url_boleto;
        } else {
            $order->forma_pagto = "cartao";
        }

        $order->save();
        return $request->url_boleto;
    }

    public function meuspedidos(Order $pedido) {
        $orders = $pedido->where('user_id', Auth::user()->id)->orderby('created_at', 'desc')->get();

        return view('meuspedidos', compact('orders'));
    }

    public function meusdados(User $user) {
        $eu = $user->where('id', Auth::user()->id)->first();


        //dd($eu);
        return view('meusdados', compact('eu'));
    }

    public function edita_meusdados_inline(Request $request, $campo, $id_user) {
        $user = new User;

        $serie = $user->find($id_user);
        $value = $request->get('value');
        $serie->$campo = $value;
        $serie->save();
    }

    public function pedidos_index(Order $pedido, User $user) {
        $pedidos = $pedido->orderby('created_at', 'desc')->get();
        $users = $user->get();

        $somaTotalPedidos = $pedido->getSomaTotal();
        $somaTotalPedidosPagos = $pedido->getSomaTotalPago();
        $somaTotalPedidosPendentes = $pedido->getSomaTotalPendente();
        $somaTotalPedidosCancelados = $pedido->getSomaTotalCancelado();

        return view("admPedidos", compact('pedidos', 'users', 'somaTotalPedidos', 'somaTotalPedidosPagos', 'somaTotalPedidosPendentes', 'somaTotalPedidosCancelados'));
    }

    public function detalhes_usuario($id_usuario, User $user) {


        $eu = $user->where('id', $id_usuario)->first();

        return view('admDados_user', compact('eu'));
    }

    public function usuarios_index(User $user) {
        $users = $user->where('role',null)->orderby('name')->get();
        return view("admListaUsers", compact('users'));
    }
    
    	public function help(){
		return view('help');
	}
    

    
    public function salva_detalhes_pedido($id_pedido, Order $order, Request $request){
		
		$pedido = $order->find($id_pedido);
		
        if($request->selEnvio == "postado"){
            $status_envio = 2;
			if (isset($request->rastreio) && ($request->rastreio !="") ){
				$user = new User;
				$user = $user->where('id',$pedido->user_id)->first();
				$user->notify(new postedNotify($user, $request->rastreio));
			}
        }else{
            $status_envio = 1;
        }
        
        
        $pedido->status_envio = $status_envio;
        $pedido->rastreio = $request->rastreio;
        $pedido->save();
		
		
        
        return view('admVerPedido', compact('pedido'));
    }

 
     public function detalhes_pedido($id_pedido, Order $order){
   
        $pedido = $order->where('id',$id_pedido)->first();
        
        return view('admVerPedido', compact('pedido'));
    }
    
    public function rastrear($cod){
        $codigo = $cod;//'PP446931304BR'; 
	$post = array('Objetos' => $codigo);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://www2.correios.com.br/sistemas/rastreamento/resultado_semcontent.cfm");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
 
	$htmlContent = curl_exec($ch);
	$htmlContent = str_replace("id=\"somediv\"", '', $htmlContent);
 
	curl_close($ch);
	libxml_use_internal_errors(false);
 
	$htmlContent = str_replace("<table class=\"listEvent sro\">", "<table class=\"\"><tr><th class='th-data'>data</th><th class='th-evento'>evento</th></tr>", $htmlContent);
	$htmlContent = str_replace(['/\\r/\\n/', '/\\r/', '/\\n/', '/\\t/', "  ", '?',], ' ', $htmlContent);
	$htmlContent = preg_replace('/\\s\\s+/', ' ', $htmlContent);
	$htmlContent = preg_replace('/\\s+/', ' ', $htmlContent);
	$htmlContent = preg_replace('/( ){2,}/', '$1', $htmlContent);
	$htmlContent = preg_replace('/\\s+/', ' ', $htmlContent);
	$htmlContent = str_replace("&nbsp;", " ", $htmlContent);
	$htmlContent = preg_replace('/\s+/', ' ', $htmlContent);
	$htmlContent = str_replace([' / '], '-', $htmlContent);
	$htmlContent = trim($htmlContent);
 
	$DOM = new \DOMDocument();
	$DOM->loadHTML($htmlContent);
 
	$Header = $DOM->getElementsByTagName('th');
	$Detail = $DOM->getElementsByTagName('td');
	
	//dd(sizeof($Header));
 
        if(sizeof($Detail) > 0 && sizeof($Header) > 0 ){
        
                foreach ($Header as $NodeHeader) {
                        $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
                }

                $i = 0;
                $j = 0;
				
			
                foreach ($Detail as $sNodeDetail) {
                        $aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
                        $i = $i + 1;
                        $j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
                }
				
				if(isset($aDataTableDetailHTML)){
				
                for ($i = 0; $i < count($aDataTableDetailHTML); $i++) {
                        for ($j = 0; $j < count($aDataTableHeaderHTML); $j++) {
                                $aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
                        }
                }

                $table = $aTempData;
                unset($aTempData);

                $cdata = array();
                $data = null;
                $local = null;
                $evento = null;
                $para = null;

                foreach ($table as $item) {

                        $var1 = $item['data'];
                        $var2 = $item['evento'];

                        $szd = strlen($var1);
                        $pieces = explode("para", $var2);
                        $data = substr($var1, 0, 17);

                        $local = substr($var1, 18, $szd);
                        $evento = $pieces[0];

                        if (isset($pieces[1])) {
                                $para = $pieces[1];
                        } else {
                                $para = '';
                        }

                        if (strcmp(trim($evento), "Objeto saiu") == 0) {
                                $evento = $pieces[0] . " para " . $pieces[1];
                                $para = '';
                        }

                        $cdata[] = [
                                'data' => trim($data),
                                'local' => trim($local),
                                'evento' => trim($evento),
                                'para' => trim($para)
                        ];
                }


                $eventos_rastreio = $cdata;
				}
        }
        return view('admRastreio', compact('eventos_rastreio', 'codigo'));
    }

    public function contato (Request $request){
	$nome = $request->get('nome');
	$email = $request->get('email');
	$tel = $request->get('tel');
	$msg = $request->get('msg');

	$str = $nome."<br>".$email."<br>".$tel."<br><br>".$msg;
	
	mail("guazarito@gmail.com","LOJA BETO - AJUDA!!!!",$str);

	return redirect(route('help'));
    }

}
