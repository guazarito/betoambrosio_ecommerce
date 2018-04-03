<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;
use Auth;


class PagSeguro extends Model
{
    	public function getSessionId(){

		$params = [
		'email'=>config('pagseguro.email'),
		'token'=>config('pagseguro.token')
		];
                

		$guzzle = new Guzzle;
		$response = $guzzle->request("POST", config('pagseguro.url_sessaopagto'), [
			'form_params' => $params,  'verify' => false, 'header'=>'<meta name="csrf-token" content="{{ csrf_token() }}">', 'allowedHeaders' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept']
		]);
		
		$body = $response->getBody();
		$contents = $body->getContents();
		
		$xml = simplexml_load_string($contents);	

		return($xml->id);	
	}
        
        public function transparente_cartao($request){
            
                $cep = str_replace("-","",$request->cep);
         
		$numcel= Auth::user()->celular;
		$numcel= str_replace("(", "", "$numcel");
		$numcel= str_replace(")", "", "$numcel");
		$numcel= str_replace("-", "", "$numcel");
		$numcel= str_replace(" ", "", "$numcel");

		$ddd= substr($numcel, 0,2);
		$phone= substr($numcel,2);

		$user_cpf = $request->holder_cpf;
		$user_cpf = str_replace(".", "", $user_cpf);
		$user_cpf = str_replace("-", "", $user_cpf);

		$holder_cpf = $request->holder_cpf;
		$holder_cpf = str_replace(".", "", $holder_cpf);
		$holder_cpf = str_replace("-", "", $holder_cpf);	

		if (env('PAGSEGURO_ENV')=="prd"){
			$user_email = Auth::user()->email;
		}else{
			$user_email = "c84634334714909739133@sandbox.pagseguro.com.br";
		}

		$total_sem_taxa = $request->valorTotal - $request->taxaPagSeguro - $request->valorFrete ;
				
		$valor_item = $total_sem_taxa/(int)$request->qtde;
		$valor_item = number_format($valor_item,2);

		$total_sem_taxa = number_format($total_sem_taxa, 2);

		$taxa = number_format($request->taxaPagSeguro,2);

		$name = preg_replace('/\d/', '', Auth::user()->name);

		
		$name = preg_replace('/[\n\t\r]/', ' ', $name);
		$name = preg_replace('/\s(?=\s)/', '', $name);
		$name = trim($name);
		$name = explode(' ', $name);
		 
		if(count($name) == 1 ) {
		    $name[] = 'da Silva';
		}
		$name = implode(' ', $name);

		$params = [
		    'email' => config('pagseguro.email'),
		    'token' => config('pagseguro.token'),
		    'senderHash' => $request->senderHash,
		    'paymentMode' => 'default',
		    'paymentMethod' => 'creditCard',
		    'currency' => 'BRL',
		    'itemId1' => '0001',
		    'itemDescription1' => 'Livro Fé Latina',
		    'itemAmount1' => number_format($valor_item,2),
		    'extraAmount'=>$taxa,
		    'itemQuantity1' => $request->qtde,
		    'reference' => $request->ref_num,
		    'senderName' => $name,
		    'senderAreaCode' => $ddd,
		    'senderPhone' => $phone,
		    'senderEmail' => $user_email,//'c46917360443542888496@sandbox.pagseguro.com.br',
		    'senderCPF' => $user_cpf,
		    'shippingType' => '1',
                    'shippingCost'=>number_format($request->valorFrete,2),
		    'creditCardToken'=>$request->cardToken,
		    'creditCardHolderName'=>strtoupper($request->holder_name),
		    'creditCardHolderCPF'=>$holder_cpf,
		    'creditCardHolderBirthDate'=>$request->holder_dtnasc,
                    'creditCardHolderAreaCode'=> $ddd,
                    'creditCardHolderPhone'=> $phone,
		    'shippingAddressStreet'=>$request->rua,
                    'shippingAddressNumber'=>$request->numero,
                    'shippingAddressComplement'=>$request->complemento,
                    'shippingAddressDistrict'=>$request->bairro,
                    'shippingAddressPostalCode'=>$cep,
                    'shippingAddressCity'=>$request->cidade,
                    'shippingAddressState'=>$request->uf,
                    'shippingAddressCountry'=>'BRA',
                    'billingAddressStreet'=>$request->rua,
                    'billingAddressNumber'=>$request->numero,
                    'billingAddressComplement'=>$request->complemento,
                    'billingAddressDistrict'=>$request->bairro,
                    'billingAddressPostalCode'=>$cep,
                    'billingAddressCity'=>$request->cidade,
                    'billingAddressState'=>$request->uf,
                    'billingAddressCountry'=>'BRA',
                    'installmentQuantity'=>'1',
                    'installmentValue'=>$request->valorTotal
		];
		
		//dd($params);
		//$params = http_build_query($params);
		
               
                
		$guzzle = new Guzzle;
		$response = $guzzle->request("POST", config('pagseguro.url_payment_transparente'), [
			'form_params' => $params,  'verify' => false, 'header'=>'<meta name="csrf-token" content="{{ csrf_token() }}">', 'allowedHeaders' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept']
		]);
		
		$body = $response->getBody();
		$contents = $body->getContents();
		
		$xml = simplexml_load_string($contents);

		
		return($xml->code);

	}
        
       public function transparente_boleto($request){
                
               
                
                $cep = str_replace("-","",$request->cep);
         
		$numcel= Auth::user()->celular;
		$numcel= str_replace("(", "", "$numcel");
		$numcel= str_replace(")", "", "$numcel");
		$numcel= str_replace("-", "", "$numcel");
		$numcel= str_replace(" ", "", "$numcel");

		$ddd= substr($numcel, 0,2);
		$phone= substr($numcel,2);

		$user_cpf = $request->holder_cpf_bol;
		$user_cpf = str_replace(".", "", $user_cpf);
		$user_cpf = str_replace("-", "", $user_cpf);

		$holder_cpf_bol = $request->holder_cpf_bol;
		$holder_cpf_bol = str_replace(".", "", $holder_cpf_bol);
		$holder_cpf_bol = str_replace("-", "", $holder_cpf_bol);	

		if (env('PAGSEGURO_ENV')=="prd"){
			$user_email = Auth::user()->email;
		}else{
			$user_email = "c46917360443542888496@sandbox.pagseguro.com.br";
		}

		$total_sem_taxa = $request->valorTotal - $request->taxaPagSeguro - $request->valorFrete ;
				
		$valor_item = $total_sem_taxa/(int)$request->qtde;
		$valor_item = number_format($valor_item,2);

		$total_sem_taxa = number_format($total_sem_taxa, 2);

		$taxa = number_format($request->taxaPagSeguro,2);

		$name = preg_replace('/\d/', '', Auth::user()->name);

		
		$name = preg_replace('/[\n\t\r]/', ' ', $name);
		$name = preg_replace('/\s(?=\s)/', '', $name);
		$name = trim($name);
		$name = explode(' ', $name);
		 
		if(count($name) == 1 ) {
		    $name[] = 'da Silva';
		}
		$name = implode(' ', $name);

		$params = [
		    'email' => config('pagseguro.email'),
		    'token' => config('pagseguro.token'),
		    'senderHash' => $request->senderHash,
		    'paymentMode' => 'default',
		    'paymentMethod' => 'boleto',
		    'currency' => 'BRL',
		    'itemId1' => '0001',
		    'itemDescription1' => 'Livro Fé Latina',
		    'itemAmount1' => number_format($valor_item,2),
		    'extraAmount'=>$taxa,
		    'itemQuantity1' => $request->qtde,
		    'reference' => $request->ref_num,
		    'senderName' => $name,
		    'senderAreaCode' => $ddd,
		    'senderPhone' => $phone,
		    'senderEmail' => $user_email,//'c46917360443542888496@sandbox.pagseguro.com.br',
		    'senderCPF' => $user_cpf,
		    'shippingType' => '1',
                    'shippingCost'=>number_format($request->valorFrete,2),
		    'shippingAddressStreet'=>$request->rua,
                    'shippingAddressNumber'=>$request->numero,
                    'shippingAddressComplement'=>$request->complemento,
                    'shippingAddressDistrict'=>$request->bairro,
                    'shippingAddressPostalCode'=>$cep,
                    'shippingAddressCity'=>$request->cidade,
                    'shippingAddressState'=>$request->uf,
                    'shippingAddressCountry'=>'BRA',
                    'billingAddressStreet'=>$request->rua,
                    'billingAddressNumber'=>$request->numero,
                    'billingAddressComplement'=>$request->complemento,
                    'billingAddressDistrict'=>$request->bairro,
                    'billingAddressPostalCode'=>$cep,
                    'billingAddressCity'=>$request->cidade,
                    'billingAddressState'=>$request->uf,
                    'billingAddressCountry'=>'BRA',
                    'installmentQuantity'=>'1',
                    'installmentValue'=>$request->valorTotal
		];
		
		//dd($params);
                $params['itemDescription1'] = utf8_decode($params['itemDescription1']);
                $params['senderName'] = utf8_decode($params['senderName']);
                $params['shippingAddressStreet'] = utf8_decode($params['shippingAddressStreet']);
                $params['shippingAddressComplement'] = utf8_decode($params['shippingAddressComplement']);
                $params['shippingAddressDistrict'] = utf8_decode($params['shippingAddressDistrict']);
                $params['shippingAddressCity'] = utf8_decode($params['shippingAddressCity']);
                $params['billingAddressStreet'] = utf8_decode($params['billingAddressStreet']);
                $params['billingAddressComplement'] = utf8_decode($params['billingAddressComplement']);
                $params['billingAddressDistrict'] = utf8_decode($params['billingAddressDistrict']);
                $params['billingAddressCity'] = utf8_decode($params['billingAddressCity']);
		//$params = http_build_query($params);
		
               //dd($params);
                
		$guzzle = new Guzzle;
		$response = $guzzle->request("POST", config('pagseguro.url_payment_transparente'), [
			'form_params' => $params,  'verify' => false, 'header'=>'<meta name="csrf-token" content="{{ csrf_token() }}">', 'allowedHeaders' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept']
		]);
		
		$body = $response->getBody();
		$contents = $body->getContents();
		
		$xml = simplexml_load_string($contents);
                
                
		return(json_encode($xml));

	}

	public function getStatusTransaction($notificationCode){
		$guzzle = new Guzzle;

		$response = $guzzle->request("GET", config('pagseguro.url_notification')."/$notificationCode", [
			'query' => "email=".config('pagseguro.email')."&token=".config('pagseguro.token') 
		]);

		$body = $response->getBody();
		$contents = $body->getContents();
		
		$xml = simplexml_load_string($contents);

		return $xml;
	}
}
