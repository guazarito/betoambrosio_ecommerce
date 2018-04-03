<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PagSeguro;
use App\Order;
use App\User;
use App\Notifications\lojaNotify;

class PagSeguroController extends Controller {

    public function pagseguro_transparente_getCode(PagSeguro $pagseguro) {
        return $pagseguro->getSessionId();
    }

    public function pagseguro_transparente_cartaocredito(PagSeguro $pagseguro, Request $request) {
        return $pagseguro->transparente_cartao($request);
    }

    public function pagseguro_transparente_boleto(PagSeguro $pagseguro, Request $request) {
        return $pagseguro->transparente_boleto($request);
    }

    //recebimento das notifications do pagseguro
    public function request(PagSeguro $pagseguro, Request $request, Order $order) {
        //return $request->all();
        if (!$request->notificationCode)
            return response()->json(['error' => 'NoNotificationCode'], 404);

        $response = $pagseguro->getStatusTransaction($request->notificationCode);

        $pedido = $order->where('reference', (string) $response->reference)->where('pagseguro_transaction_code', (string) $response->code)->first();

		
		
//        //se for status=3 manda email pro fera !
        $user = new User;
        $user = $user->where('id', $pedido->user_id)->first();
		
//
       if ((string) $response->status == "3") {
//            //$this->send_mail((string)$response->reference);
           $user->notify(new lojaNotify($user));
		  // dd('a');
        }
		
		
		
        if ((string) $response->status == "4") {
            $pedido->status = "3";
        } else {
            $pedido->status = (string) $response->status;
        }

        $pedido->save();

        return response()->json(['success' => true]);
    }

}
